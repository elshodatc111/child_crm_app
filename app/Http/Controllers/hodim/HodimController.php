<?php

namespace App\Http\Controllers\hodim;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vacancy;

class HodimController extends Controller{

    public function index(){
        $vacancy = Vacancy::orderby('id','desc')->get();
        return view('hodim.hodim',compact('vacancy'));
    }
    
}
