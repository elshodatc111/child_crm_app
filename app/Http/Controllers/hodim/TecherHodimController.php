<?php

namespace App\Http\Controllers\hodim;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TecherHodimController extends Controller
{
    public function index(){
        return view('hodim.techer_hosimlar');
    }
}
