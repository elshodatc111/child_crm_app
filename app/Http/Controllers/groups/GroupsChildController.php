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
use App\Models\ChildComment;

class GroupsChildController extends Controller{

    public function groups_show_child($id){
        $GroupChild = GroupChild::where('group_id',$id)->get();
        $child = [];
        foreach ($GroupChild as $key => $value) {
            $child[$key]['id'] = $value->child_id;
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

    public function groups_show_child_update(Request $request){
        $group_id = $request->group_id;
        $child_id = $request->child_id;
        $child = Child::find($child_id);
        $GroupChild = GroupChild::where('group_id',$group_id)->where('child_id',$child_id)->first();
        $child_about = [
            "group_id" => $group_id,
            "group_name" => Group::find($group_id)->group_name,
            "child_id" => $child->id,
            "child_name" => Child::find($child->id)->name,
            "name" => $child->name,
            "address" => $child->address,
            "birthday" => $child->birthday,
            "phone1" => $child->phone1,
            "phone2" => $child->phone2,
            "balans" => $child->balans,
            "description" => $child->name,
            "status" => $child->status,
            "created_at" => $child->name,
            'paymart_type' => $GroupChild->paymart_type,
            'group_status' => $GroupChild->status,
            'start_data' => $GroupChild->start_time,
            'start_izoh' => $GroupChild->start_comment,
            'start_meneger' => User::find($GroupChild->start_manager_id)->fio,
        ];
        return view('groups.index_show_child_update',compact('group_id','child_about'));
    }

    public function groups_show_child_delete(Request $request){
        $child_id = $request->child_id;
        $comments = $request->comments;
        $group_id = $request->group_id;
        $status = $request->status;
        $GroupChild = GroupChild::where('child_id',$child_id)->where('group_id',$group_id)->where('status','true')->first();
        $GroupChild->end_time = date("Y-m-d");
        $GroupChild->end_comment = $comments;
        $GroupChild->end_manager_id = auth()->user()->id;
        $GroupChild->status = 'false';
        $GroupChild->save();
        $Child = Child::find($child_id);
        $Child->status = 'inactive';
        $Child->save();
        ChildComment::create([
            'child_id' => $child_id,
            'description' => $comments,
            'user_id' => auth()->user()->id,
        ]);
        return redirect()->back()->with('success', 'Guruhdan o\'chirildi!');
    }

    public function groups_show_child_paymart_update(Request $request){
        $child_id = $request->child_id;
        $paymart_type = $request->paymart_type;
        $comments = $request->comments;
        $group_id = $request->group_id;
        ChildComment::create([
            'child_id' => $child_id,
            'description' => "To'lov turi o'zgartirildi: ".$comments,
            'user_id' => auth()->user()->id,
        ]);
        $GroupChild = GroupChild::where('child_id',$child_id)->where('group_id',$group_id)->where('status','true')->first();
        $GroupChild->paymart_type = $paymart_type;
        $GroupChild->save();
        return redirect()->back()->with('success', "to'lov turi o'zgartirildi!");
    }







}
