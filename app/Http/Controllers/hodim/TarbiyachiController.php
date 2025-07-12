<?php

namespace App\Http\Controllers\hodim;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vacancy;
use App\Models\User;
use App\Models\HodimDavomad;
use App\Models\PaymartChild;
use App\Models\ChildDavomad;
use App\Models\UserComment;
use App\Models\GroupsTarbiyachi;
use App\Models\Balans;
use App\Models\Group;
use App\Models\Darslar;
use App\Models\BalansHistory;
use App\Models\UserSalary;
use Carbon\Carbon;

class TarbiyachiController extends Controller{

    public function hodim_tarbiyachi(){
        $res = User::whereIn('type', ['tarbiyachi', 'kichik_tarbiyachi'])->whereIn('status', ['active','block'])->get();
        return view('hodim.tarbiyachi',compact('res'));
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
    protected function davomad($id){
        $HodimDavomad = HodimDavomad::where('user_id',$id)->where('date','>=',date('Y-m')."-01")->where('date','<=',date('Y-m')."-31")->get();
        $all = 0;
        $keldi = 0;
        $kelmadi = 0;
        $forma = 0;
        $kechikdi = 0;
        $date = [];
        $k = 0;
        foreach ($HodimDavomad as $key => $value) {
            if($value->status == 'present'){
                $all = $all + 1;
                $keldi = $keldi + 1;
                $date[$k] = $value['date'];
                $k++;
            }elseif($value->status == 'late'){
                $all = $all + 1;
                $kechikdi = $kechikdi + 1;
                $date[$k] = $value['date'];
                $k++;
            }elseif($value->status == 'absent'){
                $all = $all + 1;
                $kelmadi = $kelmadi + 1;
            }elseif($value->status == 'no_uniform'){
                $all = $all + 1;
                $forma = $forma + 1;
                $date[$k] = $value['date'];
                $k++;
            }
        }
        return [
            'all' => $all,
            'keldi' => $keldi,
            'kelmadi' => $kelmadi,
            'forma' => $forma,
            'kechikdi' => $kechikdi,
            'date' => $date,
        ];
    }
    protected function tulovlar($id){
        $UserSalary = UserSalary::where('user_id',$id)->where('created_at','>=',date("Y-m")."-01 00:00:00")->where('created_at','<=',date("Y-m")."-31 23:59:59")->get();
        $sum = 0;
        foreach ($UserSalary as $key => $value) {
            $sum = $sum + $value['amount'];
        }
        return $sum;
    }
    protected function childCount($id){
        $UserData = $this->davomad($id);
        $childCount = 0;
        $UserDateArrow = $UserData['date'];
        foreach ($UserDateArrow as $key => $value) {
            $data = $value;
            $GroupsTarbiyachi = GroupsTarbiyachi::where('user_id',$id)->get();
            foreach ($GroupsTarbiyachi as $key2 => $value2) {
                $group_id = $value2->group_id;
                $startTime = Carbon::parse($value2->start_time)->toDateString();
                $endTime = Carbon::parse($value2->end_time)->toDateString();
                $status = $value2->status==1?true:false;
                if($status){
                    if($startTime<=$data){
                        $ChildDavomad = ChildDavomad::where('group_id',$group_id)->where('data',$data)->get();
                        $childCount = $childCount + count($ChildDavomad);
                    }
                }else{
                    if($startTime<=$data AND $endTime>=$data){
                        $ChildDavomad = ChildDavomad::where('group_id',$group_id)->where('data',$data)->get();
                        $childCount = $childCount + count($ChildDavomad);
                    }
                }
            }
        }
        return $childCount;
    }
    public function show($id){
        $comment = UserComment::where('user_id',$id)->get();
        $count_comment  = count($comment);
        $balans = Balans::first();
        $about = $this->HodimAbout($id);
        $davomad = $this->davomad($id);
        $tulov = $this->tulovlar($id);
        $child_count = $this->childCount($id);
        return view('hodim.tarbiyachi.show',compact('id','balans','comment','count_comment','about','davomad','tulov','child_count'));
    }

    public function update(Request $request){
        $User = User::find($request->id);
        $User->fio = $request->fio;
        $User->phone = $request->phone;
        $User->address = $request->address;
        $User->type = $request->type;
        $User->tkun = $request->tkun;
        $User->save();
        UserComment::create([
            'user_id' => $request->id,
            'comment' => "Malumotlar taxrirlandi",
            'meneger' => auth()->user()->fio,
        ]);
        return back()->with('success', 'Malumotlar yangilandi.');
    }

    public function tarix($id){
        $GroupsTarbiyachi = GroupsTarbiyachi::where('user_id',$id)->get();
        $res = [];
        foreach ($GroupsTarbiyachi as $key => $value) {
            $res[$key]['group_id'] = $value->group_id;
            $res[$key]['group'] = Group::find($value->group_id)->group_name;
            $res[$key]['start'] = $value->start_time;
            $res[$key]['end'] = $value->end_time;
            $res[$key]['lavozim'] = $value->type;
            $res[$key]['status'] = $value->status;
        }
        return view('hodim.tarbiyachi.tarix',compact('id','res'));
    }

    public function paymart($id){
        $UserSalary = UserSalary::where('user_id',$id)->get();
        $res = [];
        foreach ($UserSalary as $key => $value) {
            $res[$key]['amount'] = $value->amount;
            $res[$key]['type'] = $value->type;
            $res[$key]['comment'] = $value->comment;
            $res[$key]['meneger'] = User::find($value->meneger_id)->fio;
            $res[$key]['created_at'] = $value->created_at;
        }
        return view('hodim.tarbiyachi.paymart',compact('id','res'));
    }

}
