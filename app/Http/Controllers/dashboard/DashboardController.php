<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Group;
use App\Models\User;
use App\Models\Child;
use App\Models\GroupChild;
use App\Models\HodimDavomad;
use App\Models\ChildDavomad;
use Carbon\Carbon;

class DashboardController extends Controller{

    protected function getLast9Days(){
        $dates = [];
        for ($i = 8; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $dates[] = [
                'full' => $date->format('Y-m-d'), // Masalan: 2025-07-12
                'short' => $date->format('M-d'),  // Masalan: Jul-12
            ];
        }
        return $dates;
    }

    protected function getHodimDavomad(){
        $res = [];
        foreach ($this->getLast9Days() as $key => $value) {
            $date = $value['full'];
            $HodimDavomad = HodimDavomad::where('date',$date)->get();
            $count = 0;
            foreach ($HodimDavomad as $key2 => $value2) {
                if($value2->status =='absent'){

                }elseif($value2->status == 'off_day'){

                }else{
                    $count = $count + 1;
                }
            }
            $res[$key] = $count;
        }
        return $res;
    }

    protected function getChildDavomad(){
        $res = [];
        foreach ($this->getLast9Days() as $key => $value) {
            $date = $value['full'];
            $ChildDavomad = ChildDavomad::where('data',$date)->get();
            $count = 0;
            foreach ($ChildDavomad as $key2 => $value2) {
                if($value2->status =='keldi'){
                    $count = $count + 1;
                }
            }
            $res[$key] = $count;
        }
        return $res;
    }

    public function home(){
        $countChild = count(GroupChild::where('status','true')->get());
        $countDebedChild = count(Child::where('balans','<',0)->get());
        $countActiveHodim = count(User::where('status','active')->get());
        $countActiveGroups = count(Group::where('status','true')->get());
        $chartDay = $this->getLast9Days();
        $hodimDavomad = $this->getHodimDavomad();
        $childDavomad = $this->getChildDavomad();
        return view('dashboard',compact('countChild','countDebedChild','countActiveHodim','countActiveGroups','chartDay','hodimDavomad','childDavomad'));
    }



}
