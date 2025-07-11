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
use Carbon\Carbon;

class TecherHodimController extends Controller{

    public function index(){
        $techer = User::where('type','techer')->get();
        return view('hodim.techer_hosimlar',compact('techer'));
    }

    public function show($id){
        $UserComment = UserComment::where('user_id',$id)->get();
        $countComment = count($UserComment);
        return view('hodim.techer.show',compact('id','UserComment','countComment',));
    }

    public function tarix($id){
        return view('hodim.techer.tarix',compact('id'));
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

}
