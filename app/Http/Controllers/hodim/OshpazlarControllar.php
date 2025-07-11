<?php

namespace App\Http\Controllers\hodim;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\HodimDavomad;
use App\Models\PaymartChild;
use App\Models\UserComment;
use App\Models\Balans;
use App\Models\BalansHistory;
use App\Models\UserSalary;
use App\Models\ChildDavomad;
use Carbon\Carbon;


class OshpazlarControllar extends Controller{

    public function hodim_oshpazlar(){
        $res = User::where('type', 'oshpaz')->whereIn('status', ['active','block'])->get();
        return view('hodim.oshpaz',compact('res'));
    }
    protected function about($id){
        $User = User::find($id);
        return [
            'fio' => $User->fio,
            'phone' => $User->phone,
            'address' => $User->address,
            'status' => $User->status,
            'tkun' => $User->tkun,
            'created_at' => $User->created_at,
        ];
    }
    protected function ishKunlari($id){
        $startOfMonth = Carbon::now()->startOfMonth()->toDateString();
        $endOfMonth = Carbon::now()->endOfMonth()->toDateString();
        $HodimDavomad = HodimDavomad::where('user_id', $id)->whereBetween('date', [$startOfMonth, $endOfMonth])->get();
        $barcha = 0;
        $keldi = 0;
        $kelmadi = 0;
        $kechikdi = 0;
        $forma_yoq = 0;
        $ish_kun_emas = 0;
        foreach ($HodimDavomad as $key => $value) {
            if($value->status == 'present'){
                $keldi = $keldi + 1;
                $barcha = $barcha + 1;
            }elseif($value->status == 'absent'){
                $kelmadi = $kelmadi + 1;
            }elseif($value->status == 'late'){
                $kechikdi = $kechikdi + 1;
                $barcha = $barcha + 1;
            }elseif($value->status == 'no_uniform'){
                $forma_yoq = $forma_yoq + 1;
                $barcha = $barcha + 1;
            }elseif($value->status == 'off_day'){
                $ish_kun_emas = $ish_kun_emas + 1;
            }
        }
        return [
            'barcha' => $barcha,
            'kechikdi' => $kechikdi,
            'keldi' => $keldi,
            'kelmadi' => $kelmadi,
            'forma_yoq' => $forma_yoq,
            'ish_kun_emas' => $ish_kun_emas,
        ];
    }

    protected function joriyOyKunlari($id){
        $startOfMonth = Carbon::now()->startOfMonth()->toDateString();
        $endOfMonth = Carbon::now()->endOfMonth()->toDateString();
        $HodimDavomad = HodimDavomad::where('user_id', $id)->whereBetween('date', [$startOfMonth, $endOfMonth])->get();
        $data = [];
        $i = 0;
        foreach ($HodimDavomad as $key => $value) {
            if($value->status == 'present' OR $value->status == 'no_uniform' OR $value->status == 'late'){
                $data[$i] = $value->date;
                $i++;
            }
        }
        return $data;
    }
    protected function xizmat_child(array $data){
        $count = 0;
        foreach ($data as $key => $value) {
            $ChildDavomad = ChildDavomad::where('data',$value)->where('status','keldi')->get();
            foreach ($ChildDavomad as $key => $value) {
               $count = $count + 1;
            }
        }
        return $count;
    }

    protected function xizmat_emploes(array $data){
        $count = 0;
        foreach ($data as $key => $value) {
            $HodimDavomad = HodimDavomad::where('date',$value)->whereIn('status',['present','late','no_uniform'])->get();
            foreach ($HodimDavomad as $key => $value) {
                $count = $count + 1;
            }
        }
        return $count;
    }

    public function oshpaz_show($id){
        $comment = UserComment::where('user_id',$id)->get();
        $count_comment = count($comment);
        $about = $this->about($id);
        $ish_kun = $this->ishKunlari($id);
        $ish_kun_date = $this->joriyOyKunlari($id);
        $child_count = $this->xizmat_child($ish_kun_date);
        $emploes_count = $this->xizmat_emploes($ish_kun_date);
        $balans = Balans::first();
        return view('hodim.oshpaz.show',compact('id','comment','count_comment','about','ish_kun','child_count','emploes_count','balans'));
    }

    public function oshpaz_paymart($id){
        $UserSalary = UserSalary::where('user_id',$id)->get();
        $res = [];
        foreach ($UserSalary as $key => $value) {
            $res[$key]['amount'] = $value->amount;
            $res[$key]['type'] = $value->type;
            $res[$key]['comment'] = $value->comment;
            $res[$key]['meneger'] = User::find($value->meneger_id)->fio;
            $res[$key]['created_at'] = $value->created_at;
        }
        return view('hodim.oshpaz.paymart',compact('id','res'));
    }


}
