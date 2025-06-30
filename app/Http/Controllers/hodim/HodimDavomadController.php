<?php

namespace App\Http\Controllers\hodim;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HodimDavomadController extends Controller{

    public function meneger(){
        return view('hodim.davomad.menejer');
    }

    public function tarbiyachi(){
        return view('hodim.davomad.tarbiyachi');    
    }

    public function oshpaz(){
        return view('hodim.davomad.oshpaz');    
    }

    public function hodim(){
        return view('hodim.davomad.hodim');    
    }

}
