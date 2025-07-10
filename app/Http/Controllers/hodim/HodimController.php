<?php

namespace App\Http\Controllers\hodim;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vacancy;
use App\Models\User;
use App\Models\HodimDavomad;
use App\Models\PaymartChild;
use App\Models\UserComment;
use App\Models\Balans;
use App\Models\BalansHistory;
use App\Models\UserSalary;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class HodimController extends Controller{

    public function index(){
        $res = User::whereIn('type', ['direktor', 'menejer'])->whereIn('status', ['active','block'])->get();
        return view('hodim.index',compact('res'));
    }

    protected function MenegerAbout($id){
        $User = User::find($id);
        return [
            'id' => $User->id,
            'fio' => $User->fio,
            'phone' => $User->phone,
            'address' => $User->address,
            'type' => $User->type,
            'tkun' => $User->tkun,
            'status' => $User->status,
            'email' => $User->email,
            'created_at' => $User->created_at,
        ];
    }
    protected function davomadCount($id){
        $HodimDavomad = HodimDavomad::where('user_id',$id)->get();
        $keldi = 0;
        $kelmadi = 0;
        $kechikdi = 0;
        $forma = 0;
        $ishkunemas = 0;
        foreach ($HodimDavomad as $key => $value) {
            if($value->status == 'present'){
                $keldi = $keldi + 1;
            }elseif($value->status == 'absent'){
                $kelmadi = $kelmadi + 1;
            }elseif($value->status == 'late'){
                $kechikdi = $kechikdi + 1;
            }elseif($value->status == 'no_uniform'){
                $forma = $forma + 1;
            }else{
                $ishkunemas = $ishkunemas + 1;
            }
        }
        return [
            'all' => count($HodimDavomad),
            'keldi' => $keldi,
            'kelmadi' => $kelmadi,
            'kechikdi' => $kechikdi,
            'formada_emas' => $forma,
            'ish_kuni_emas' => $ishkunemas,
        ];
    }
    protected function paymartsAll($id){
        $PaymartChild = PaymartChild::where('user_id',$id)->get();
        $naqt = 0;
        $plastik = 0;
        foreach ($PaymartChild as $key => $value) {
            if($value->status == 'tulov'){
                if($value->type == 'naqt'){
                    $naqt = $naqt + $value['amount'];
                }else{
                    $plastik = $plastik + $value['amount'];
                }
            }
            if($value->status == 'qaytar'){
                if($value->type == 'naqt'){
                    $naqt = $naqt - $value['amount'];
                }else{
                    $plastik = $plastik - $value['amount'];
                }
            }
        }
        return [
            'naqt' => $naqt,
            'plastik' => $plastik,
        ];
    }

    public function hodim_show_update_post(Request $request){
        $user = User::find($request->id);
        $user->fio = $request->fio;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->tkun = $request->tkun;
        $user->type = $request->type;
        $user->save();
        return redirect()->back()->with('success', 'Hodim malumotlari yangilandi!');
    }

    public function hodim_show_update_post_status(Request $request){
        $User = User::find($request->id);
        $User->status = $request->type;
        $User->save();
        UserComment::create([
            'user_id' => $request->id,
            'comment' => "Holat yangilandi: ".$request->comment."(".$request->type.")",
            'meneger' => auth()->user()->fio,
        ]);
        return redirect()->back()->with('success', 'Hodim holati yangilandi!');
    }

    public function hodim_showcreate_commentss(Request $request){
        UserComment::create([
            'user_id' => $request->id,
            'comment' => $request->comment,
            'meneger' => auth()->user()->fio,
        ]);
        return redirect()->back()->with('success', 'Eslatma saqalndi!');
    }

    public function updatePassword(Request $request){
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:users,id',
            'new_password' => 'required|string|min:8',
            'repet_password' => 'required|same:new_password',
        ], [
            'id.required' => 'Foydalanuvchi aniqlanmadi.',
            'new_password.required' => 'Yangi parolni kiriting.',
            'repet_password.same' => 'Parollar mos emas.',
            'new_password.min' => 'Yangi parol kamida 8 ta belgidan iborat bo‘lishi kerak.',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $user = User::findOrFail($request->id);
        $user->password = Hash::make($request->new_password);
        $user->save();
        return back()->with('success', 'Parol muvaffaqiyatli yangilandi.');
    }

    protected function checkPrice($type,$naqt,$plastik,$amount){
        if($type=='naqt'){
            if($naqt>=$amount){
                return false;
            }else{
                return true;
            }
        }else{
            if($plastik>=$amount){
                return false;
            }else{
                return true;
            }
        }
    }

    protected function balansChiqim($type,$amount,$comment){
        $Balans = Balans::first();
        if($type=='naqt'){
            $Balans->naqt = $Balans->naqt - $amount;
        }else{
            $Balans->plastik = $Balans->plastik - $amount;
        }
        BalansHistory::create([
            'status' => $type=='naqt'?'naqt_ish_haqi':'plastik_ish_haqi',
            'type' => 'success',
            'amount' => $amount,
            'start_comment' => $comment,
            'start_user_id' => auth()->user()->id,
        ]);
        return $Balans->save();
    }

    public function hodim_create_paymarts(Request $request){
        $amount = str_replace(" ","",$request->amount);
        if($this->checkPrice($request->payment_type, $request->naqt, $request->plastik, $amount)){
            return back()->with('error', 'Balansda yetarli mablag\' mavjud emas.');
        }
        $this->balansChiqim($request->payment_type, $amount, $request->note);
        UserSalary::create([
            'user_id' => $request->id,
            'meneger_id' => auth()->user()->id,
            'amount' => $amount,
            'type' => $request->payment_type,
            'comment' => $request->note,
        ]);
        return back()->with('success', 'Ish haqi to\'lovi amalga oshirildi.');
    }

    public function meneger_show($id){
        $about = $this->MenegerAbout($id);
        $davomad = $this->davomadCount($id);
        $paymart = $this->paymartsAll($id);
        $comments = UserComment::where('user_id',$id)->get();
        $count_comment = count($comments);
        $balans = Balans::first();
        return view('hodim.meneger.meneger_show',compact('id','about','davomad','paymart','comments','count_comment','balans'));
    }
    public function meneger_show_paymart($id){
        $UserSalary = UserSalary::where('user_id',$id)->get();
        $res = [];
        foreach ($UserSalary as $key => $value) {
            $res[$key]['amount'] = $value->amount;
            $res[$key]['type'] = $value->type;
            $res[$key]['comment'] = $value->comment;
            $res[$key]['created_at'] = $value->created_at;
            $res[$key]['meneger'] = User::find($value->meneger_id)->fio;
        }
        return view('hodim.meneger.meneger_show_paymart',compact('id','res'));
    }









}
