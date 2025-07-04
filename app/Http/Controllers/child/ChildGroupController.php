<?php

namespace App\Http\Controllers\child;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Group;
use App\Models\Child;
use App\Models\GroupChild;

class ChildGroupController extends Controller{

    public function show_group($id){
        $GroupChild = GroupChild::where('child_id',$id)->get();
        $groups = [];
        foreach ($GroupChild as $key => $value) {
            $groups[$key]['group_id'] = $value->group_id;
            $groups[$key]['group_name'] = Group::find($value->group_id)->group_name;
            $groups[$key]['start_time'] = $value->start_time;
            $groups[$key]['end_time'] = $value->end_time!=null?$value->end_time:"";
            $groups[$key]['start_comment'] = $value->start_comment;
            $groups[$key]['end_comment'] = $value->end_comment!=null?$value->end_comment:"";
            $groups[$key]['paymart_type'] = $value->paymart_type;
            $groups[$key]['status'] = $value->status;
            $groups[$key]['start_manager_id'] = User::find($value->start_manager_id)->fio;
            $groups[$key]['end_manager_id'] = $value->end_menager_id!=null?User::find($value->end_manager_id)->fio:"";
        }
        return view('child.active.group_show',compact('id','groups'));
    }

    
}
