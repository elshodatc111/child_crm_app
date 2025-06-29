<?php

namespace App\Http\Controllers\groups;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Group;
use App\Models\GroupsTarbiyachi;
use App\Http\Requests\StoreGroupRequest;

class GroupsController extends Controller{

    public function index(){
        $Groups = Group::where('status','true')->get();
        $Group = [];
        foreach ($Groups as $key => $value) {
            $Group[$key]['id'] = $value->id;
            $Group[$key]['name'] = $value->group_name;
            $Group[$key]['price_month'] = $value->price_month;
            $Group[$key]['price_day'] = $value->price_day;
            $Group[$key]['child'] = 0;
        }
        return view('groups.index',compact('Group'));
    }

    public function arxiv_index(){
        $Groups = Group::where('status','false')->get();
        $Group = [];
        foreach ($Groups as $key => $value) {
            $Group[$key]['id'] = $value->id;
            $Group[$key]['name'] = $value->group_name;
            $Group[$key]['price_month'] = $value->price_month;
            $Group[$key]['price_day'] = $value->price_day;
        }
        return view('groups.arxiv_index',compact('Group'));
    }

    public function new_index(){
        $Katta = User::where('type','tarbiyachi')->get();
        $katta = [];
        foreach ($Katta as $key => $value) {
            $id = $value->id;
            $check = GroupsTarbiyachi::where('user_id',$id)->where('status',1)->get();
            if(count($check)==0){
                $katta[$key]['id'] = $id;
                $katta[$key]['name'] = $value->fio;
            }
        }
        $Kichik = User::where('type','kichik_tarbiyachi')->get();
        $kichik = [];
        foreach ($Kichik as $key => $value) {
            $id = $value->id;
            $check = GroupsTarbiyachi::where('user_id',$id)->where('status',1)->get();
            if(count($check)==0){
                $kichik[$key]['id'] = $id;
                $kichik[$key]['name'] = $value->fio;
            }
        }
        return view('groups.new_index',compact('katta','kichik'));
    }

    public function create_group(StoreGroupRequest $request){
        $data = $request->validated();
        $Group = Group::create([
            'group_name' => $request->group_name,
            'price_month' => $request->price_month,
            'price_day' => $request->price_day,
            'status' => 'true',
            'user_id' => auth()->user()->id,
        ]);
        GroupsTarbiyachi::create([
            'group_id' => $Group->id,
            'user_id' => $request->user_id1,
            'start_time' => date("Y-m-d"),
            'type' => 'tarbiyachi',
            'status' => 1,
        ]);
        GroupsTarbiyachi::create([
            'group_id' => $Group->id,
            'user_id' => $request->user_id2,
            'start_time' => date("Y-m-d"),
            'type' => 'yordamchi',
            'status' => 1,
        ]);
        return redirect()->route('groups_show',$Group->id);
    }

    public function groups_show($id){
        dd($id);
    }
}
