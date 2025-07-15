<?php

namespace App\Http\Controllers\chart;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ChartController extends Controller
{
    public function index(){
        return view('chart.index');
    }
}
