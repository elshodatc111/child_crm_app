<?php

namespace App\Http\Controllers\hodim;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class TarbiyachiController extends Controller
{
    public function hodim_tarbiyachi(){
        $res = User::whereIn('type', ['tarbiyachi', 'kichik_tarbiyachi'])->whereIn('status', ['active','block'])->get();
        return view('hodim.tarbiyachi',compact('res'));
    }
}
