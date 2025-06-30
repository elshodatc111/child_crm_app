<?php

namespace App\Http\Controllers\hodim;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vacancy;
use App\Models\User;

class BoshqaHodimController extends Controller{

    public function index(){
        $res = User::whereNotIn('type', ['tarbiyachi', 'kichik_tarbiyachi', 'direktor', 'menejer', 'oshpaz'])->whereIn('status', ['active','block'])->get();
        return view('hodim.boshqa_hosimlar',compact('res'));
    }
    
    public function show($id){
        return view('hodim.boshqa.boshqa_hosim_show',compact('id')); 
    }
    
    public function tulovlar($id){
        return view('hodim.boshqa.boshqa_hosim_show_tulovlar',compact('id')); 
    }

}
