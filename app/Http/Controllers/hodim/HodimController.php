<?php

namespace App\Http\Controllers\hodim;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HodimController extends Controller{

    public function index(){
        return view('hodim.hodim');
    }
    
}
