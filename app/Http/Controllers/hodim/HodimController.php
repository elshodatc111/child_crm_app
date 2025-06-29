<?php

namespace App\Http\Controllers\hodim;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vacancy;
use App\Models\User;

class HodimController extends Controller{

    public function index(){
        $res = [];
        $res['meneger'] = User::whereIn('type', ['direktor', 'menejer'])->whereIn('status', ['active','block'])->get();
        return view('hodim.index',compact('res'));
    }

    public function hodim_tarbiyachi(){
        $res = [];
        $res['tarbiyachi'] = User::whereIn('type', ['tarbiyachi', 'kichik_tarbiyachi'])->whereIn('status', ['active','block'])->get();
        return view('hodim.tarbiyachi',compact('res'));
    }

    public function hodim_oshpazlar(){
        $res = [];
        $res['oshpaz'] = User::where('type', 'oshpaz')->whereIn('status', ['active','block'])->get();
        return view('hodim.oshpaz',compact('res'));
    }

    public function hodim_boshqalar(){
        $res = [];
        $res['hodim'] = User::whereNotIn('type', ['tarbiyachi', 'kichik_tarbiyachi', 'direktor', 'meneger', 'oshpaz'])->whereIn('status', ['active','block'])->get();
        return view('hodim.boshqa_hosimlar',compact('res'));
    }



}
