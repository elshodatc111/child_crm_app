<?php

namespace App\Http\Controllers\child;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CildController extends Controller
{
    public function index(){
        return view('child.index');
    }
    public function index_end(){
        return view('child.index_end');
    }
    public function index_debit(){
        return view('child.index_debit');
    }
}
