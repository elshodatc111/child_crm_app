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

class GroupsChildController extends Controller{

    public function groups_show_child($id){
        $GroupChild = GroupChild::where('group_id',$id)->get();
        $child = [];
        foreach ($GroupChild as $key => $value) {
            $child[$key]['id'] = $value->id;
            $child[$key]['child'] = Child::find($value->child_id)->name;
            $child[$key]['balans'] = Child::find($value->child_id)->balans;
            $child[$key]['start_time'] = $value->start_time;
            $child[$key]['start_comment'] = $value->start_comment;
            $child[$key]['start_manejer'] = User::find($value->start_manager_id)->fio;
            $child[$key]['end_time'] = $value->end_manager_id!=null?$value->end_time:"";
            $child[$key]['end_comment'] = $value->end_manager_id!=null?$value->end_comment:"";
            $child[$key]['paymart_type'] = $value->paymart_type;
            $child[$key]['status'] = $value->status;
            $child[$key]['end_manejer'] = $value->end_manager_id!=null?User::find($value->end_manager_id)->fio:'';
        }
        return view('groups.index_show_child', compact('id','child'));
    }







}
