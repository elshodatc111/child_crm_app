<?php

namespace App\Http\Controllers\hodim;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class OshpazlarControllar extends Controller
{
    public function hodim_oshpazlar(){
        $res = User::where('type', 'oshpaz')->whereIn('status', ['active','block'])->get();
        return view('hodim.oshpaz',compact('res'));
    }


    
}
