<?php

namespace App\Http\Controllers\hodim;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vacancy;
use App\Models\User;

class HodimController extends Controller{

    public function index(){
        $res = User::whereIn('type', ['direktor', 'menejer'])->whereIn('status', ['active','block'])->get();
        return view('hodim.index',compact('res'));
    }
    
    public function meneger_show($id){
        return view('hodim.meneger.meneger_show',compact('id'));
    }

    public function meneger_show_paymart($id){
        return view('hodim.meneger.meneger_show_paymart',compact('id'));
    }









}
