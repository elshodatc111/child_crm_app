<?php

namespace App\Http\Controllers\chart;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ChartController extends Controller{
    protected function oldSevenDay(){
        $res = [];
        $variable = [6,5,4,3,2,1,0];
        foreach ($variable as $key => $value) {
            $date = Carbon::today()->subDays($value);
            $res[$key]['full'] = $date->format('Y-m-d');
            $res[$key]['short'] = $date->format('m-d');
        };
        return $res;
    }
    protected function oldSevenMonth(){
        $res = [];
        $variable = [6,5,4,3,2,1,0];
        foreach ($variable as $key => $value) {
            $date = \Carbon\Carbon::today()->subMonths($value);
            $res[$key] = $date->format('Y-m'); // to‘liq: 2025-07
        }
        return $res;
    }
    public function index(){
        $days = $this->oldSevenDay();
        return view('chart.index',compact('days'));
    }

    public function oylik(){
        $monch = $this->oldSevenMonth();
        return view('chart.oylik',compact('monch'));
    }
}
