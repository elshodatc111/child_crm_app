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
use App\Models\Group;
use App\Models\Darslar;
use App\Models\BalansHistory;
use App\Models\UserSalary;
use Carbon\Carbon;

class TecherHodimController extends Controller{

    public function index(){
        $techer = User::where('type','techer')->get();
        return view('hodim.techer_hosimlar',compact('techer'));
    }

    protected function tulovlar($id){
        $now = date("Y-m");
        $UserSalary = UserSalary::where('user_id',$id)->where('created_at','>=',$now."-01 00:00:00")->where('created_at','<=',$now."-31 23:59:59")->get();
        $res = 0;
        foreach ($UserSalary as $key => $value) {
            $res = $res + $value->amount;
        }
        return $res;
    }
    protected function countDars($id){
        $now = date("Y-m");
        $Darslar = Darslar::where('teacher_id',$id)->where('created_at','>=',$now."-01 00:00:00")->where('created_at','<=',$now."-31 23:59:59")->get();
        $count = count($Darslar);
        $child_count = 0;
        foreach ($Darslar as $key => $value) {
            $child_count = $child_count + $value->child_count;
        }
        return [
            'darslar' => $count,
            'child' => $child_count,
        ];
    }

    public function show($id){
        $UserComment = UserComment::where('user_id',$id)->get();
        $countComment = count($UserComment);
        $about = User::find($id);
        $balans = Balans::first();
        $tulov = $this->tulovlar($id);
        $group = Group::where('status','true')->get();
        $count = $this->countDars($id);
        return view('hodim.techer.show',compact('id','UserComment','countComment','about','balans','tulov','group','count'));
    }

    public function tarix($id){
        $dars = Darslar::where('teacher_id',$id)->get();
        $res = [];
        foreach ($dars as $key => $value) {
            $res[$key]['id'] = $value->id;
            $res[$key]['group_name'] = Group::find($value->group_id)->group_name;
            $res[$key]['lesson_name'] = $value->lesson_name;
            $res[$key]['child_count'] = $value->child_count;
            $res[$key]['meneger'] = User::find($value->user_id)->fio;
            $res[$key]['created_at'] = $value->created_at;
        }
        return view('hodim.techer.tarix',compact('id','res'));
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
        return view('hodim.techer.paymart',compact('id','res'));
    }

    public function update(Request $request){
        $User = User::find($request->id);
        $User->fio = $request->fio;
        $User->phone = $request->phone;
        $User->address = $request->address;
        $User->tkun = $request->tkun;
        $User->save();
        UserComment::create([
            'user_id' => $request->id,
            'comment' => "Taxrirlandi",
            'meneger' => auth()->user()->fio,
        ]);
        return redirect()->back()->with('success', 'O\'qituvchi ma`lumotlari yangilandi!');
    }

    public function create_dars(Request $request){
        Darslar::create([
            'group_id' => $request->group_id,
            'teacher_id' => $request->techer_id,
            'lesson_name' => $request->lesson_name,
            'child_count' => (int) $request->child_count,
            'user_id' => auth()->user()->id,
        ]);
        return redirect()->back()->with('success', 'Yangi dars saqlandi!');
    }

}
