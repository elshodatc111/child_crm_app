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

class BoshqaHodimController extends Controller{

    public function index(){
        $res = User::whereNotIn('type', ['tarbiyachi', 'kichik_tarbiyachi', 'direktor', 'menejer', 'oshpaz'])->whereIn('status', ['active','block'])->get();
        return view('hodim.boshqa_hosimlar',compact('res'));
    }

    public function create_comments(Request $request){
        UserComment::create([
            'user_id' => $request->user_id,
            'comment' => $request->comment,
            'meneger' => auth()->user()->fio,
        ]);
        return back()->with('success', 'Hodim haqida izoh qoldirildi.');
    }

    protected function HodimAbout($id){
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

    public function update_status(Request $request){
        $User = User::find($request->user_id);
        $User->status = $request->status;
        $User->save();
        UserComment::create([
            'user_id' => $request->user_id,
            'comment' => $request->note." ( ".$request->status." )",
            'meneger' => auth()->user()->fio,
        ]);
        return back()->with('success', 'Hodim ish faoliyati yangilandi.');
    }

    public function show($id){
        $UserComment = UserComment::where('user_id',$id)->get();
        $countComment = count($UserComment);
        $about = $this->HodimAbout($id);
        $davomad = $this->davomadCount($id);
        $balans = Balans::first();
        //dd($davomad);
        return view('hodim.boshqa.boshqa_hosim_show',compact('id','UserComment','countComment','about','davomad','balans'));
    }

    public function paymart_post(Request $request){
        $user_id = $request->user_id;
        $naqt = (int) $request->naqt;
        $plastik = (int) $request->plastik;
        $amount = (int) str_replace(" ","",$request->amount);
        $payment_type = $request->payment_type;
        $comment = $request->comment;
        $balans = Balans::first();
        if($payment_type=='naqt'){
            if($naqt<$amount){
                return back()->with('error', 'Balansda yetarli mablag\' mavjud emas.');
            }else{
                $balans->naqt = $balans->naqt - $amount;
                UserSalary::create([
                    'user_id' => $request->user_id,
                    'meneger_id' => auth()->user()->id,
                    'amount' => $amount,
                    'type' => $request->payment_type,
                    'comment' => $request->comment,
                ]);
            }
        }else{
            if($plastik<$amount){
                return back()->with('error', 'Balansda yetarli mablag\' mavjud emas.');
            }else{
                $balans->plastik = $balans->plastik - $amount;
                UserSalary::create([
                    'user_id' => $request->user_id,
                    'meneger_id' => auth()->user()->id,
                    'amount' => $amount,
                    'type' => $request->payment_type,
                    'comment' => $request->comment,
                ]);
            }
        }
        $balans->save();
        return back()->with('success', 'Ish haqi to\'lovi amalga oshirildi.');
    }

    public function tulovlar($id){
        $UserSalary = UserSalary::where('user_id',$id)->get();
        $res = [];
        foreach ($UserSalary as $key => $value) {
            $res[$key]['amount'] = $value->amount;
            $res[$key]['type'] = $value->type;
            $res[$key]['comment'] = $value->comment;
            $res[$key]['meneger'] = User::find($value->meneger_id)->fio;
            $res[$key]['created_at'] = $value->created_at;
        }
        return view('hodim.boshqa.boshqa_hosim_show_tulovlar',compact('id','res'));
    }

}
