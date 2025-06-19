<?php

namespace App\Http\Controllers\hodim;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vacancy;
use App\Models\User;

class HodimController extends Controller{

    public function index(){
        $res = [];
        $res['meneger'] = User::whereIn('type', ['direktor', 'meneger'])->whereIn('status', ['active','block'])->get();
        $res['tarbiyachi'] = User::whereIn('type', ['tarbiyachi', 'kichik_tarbiyachi'])->whereIn('status', ['active','block'])->get();
        $res['oshpaz'] = User::where('type', 'oshpaz')->whereIn('status', ['active','block'])->get();
        $res['hodim'] = User::whereNotIn('type', ['tarbiyachi', 'kichik_tarbiyachi', 'direktor', 'meneger', 'oshpaz'])->whereIn('status', ['active','block'])->get();
        $res['arxiv'] = User::where('status', 'delete')->get();
        $res['vacancy'] = Vacancy::orderBy('id', 'desc')->get();
        return view('hodim.hodim',compact('res'));
    }

}
