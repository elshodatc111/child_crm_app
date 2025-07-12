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
use App\Models\Darslar;

class GroupsDarslarController extends Controller
{
    public function index($id){
        $Darslar = Darslar::where('group_id',$id)->get();
        $res = [];
        foreach ($Darslar as $key => $value) {
            $res[$key]['techer'] = User::find($value->teacher_id)->fio;
            $res[$key]['dars'] = $value->lesson_name;
            $res[$key]['count'] = $value->child_count;
            $res[$key]['meneger'] = User::find($value->user_id)->fio;
            $res[$key]['created_at'] = $value->created_at;
        }
        return view('groups.index_show_dars',compact('id','res'));
    }
}
