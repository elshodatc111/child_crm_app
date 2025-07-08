<?php

namespace App\Http\Controllers\groups;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Group;
use App\Models\GroupsTarbiyachi;
use App\Models\GroupChild;
use App\Models\DamKunlar;
use App\Models\Child;
use App\Models\ChildDavomad;

class GroupDavomatController extends Controller{

    protected function getWorkingDays($type){
        $days = [];
        $year = date('Y');
        $month = date('m');
        $startDate = strtotime("$year-$month-01");
        $endDate = strtotime(date("Y-m-t", $startDate));
        for ($date = $startDate; $date <= $endDate; $date = strtotime('+1 day', $date)) {
            $dayOfWeek = date('N', $date);

            if ($dayOfWeek >= 1 && $dayOfWeek <= $type) {
                $days[] = date('Y-m-d', $date);
            }
        }
        $i = 0;
        foreach ($days as $key => $value) {
            $DamKunlar = DamKunlar::where('data',$value)->first();
            if(!$DamKunlar){
                $i++;
            }
        }
        return $i;
    }

    protected function IshKunlarSoni($group_type){
        if($group_type=='besh'){
            return $this->getWorkingDays(5);
        }else{
            return $this->getWorkingDays(6);
        }
    }

    protected function childDexrementBalans($child_id,$group_id,$status){
        $Child = Child::find($child_id);
        $GroupChild = GroupChild::where('child_id',$child_id)->where('group_id',$group_id)->where('status','true')->first();
        if($GroupChild->paymart_type == 'day' AND $status == 'keldi'){
            $pay = Group::find($group_id)->price_day;
        }elseif($GroupChild->paymart_type == 'day' AND $status == 'kelmadi'){
            $pay = 0;
        }else{
            $dayCount = $this->IshKunlarSoni($GroupChild->group_type);
            $pay = (Group::find($group_id)->price_month)/$dayCount;
        }
        $Child->balans = $Child->balans - $pay;
        $Child->save();
        return $pay;
    }

    public function groups_create_davomat(Request $request){
        $attendances = $request->input('attendance');
        $group_id = $request->group_id;
        $this->IshKunlarSoni('besh');
        foreach ($attendances as $child_id => $status) {
            $balans = $this->childDexrementBalans($child_id,$group_id,$status);
            ChildDavomad::create([
                'child_id' => $child_id,
                'group_id' => $group_id,
                'data' => date('Y-m-d'),
                'amount' => $balans,
                'status' => $status,
                'user_id' => auth()->user()->id,
            ]);
        }
        return redirect()->back()->with('success', 'Guruh davomadi saqalndi!');
    }

    protected function getWorkingDaysYMD($type){
        $days = [];
        $year = date('Y');
        $month = date('m');
        $startDate = strtotime("$year-$month-01");
        $endDate = strtotime(date("Y-m-t", $startDate));
        for ($date = $startDate; $date <= $endDate; $date = strtotime('+1 day', $date)) {
            $dayOfWeek = date('N', $date);
            if ($dayOfWeek >= 1 && $dayOfWeek <= $type) {
                $days[] = date('m-d', $date);
            }
        }
        $res = [];
        $k = 0;
        foreach ($days as $key => $value) {
            $DamKunlar = DamKunlar::where('data',$value)->first();
            if(!$DamKunlar){
                $res[$k] = $value;
                $k++;
            }
        }
        return $res;
    }

    public function groups_show_davomad($group_id){
        $id = $group_id;
        $startDate = Date("Y-m")."-01";
        $endDate = date("Y-m-t", strtotime($startDate));
        $now = date('Y-m-d');
        $days = $this->getWorkingDaysYMD(5);
        $Child = GroupChild::where('group_id',$group_id)->get();
        $childs = [];
        foreach ($Child as $key => $value) {
            $childs[$key]['child_id'] = $value->child_id;
            $childs[$key]['child_name'] = Child::find($value->child_id)->name;
            $natija = [];
            foreach ($days as $key2 => $value2) {
                if(date('Y')."-".$value2>$now){
                    $natija[$key2] = 'kutilmoqda';
                }else{
                    $ChildDavomad = ChildDavomad::where('child_id',$value->child_id)->where('group_id',$group_id)->where('data',date('Y')."-".$value2)->first();
                    if($ChildDavomad){
                        $natija[$key2] = $ChildDavomad->status;
                    }else{
                        $natija[$key2] = 'Olinmadi';
                    }
                }
            }
            $childs[$key]['natija'] = $natija;
        }
        return view('groups.index_show_davomad', compact('id','days','childs') );
    }

}
