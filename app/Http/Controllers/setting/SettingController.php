<?php

namespace App\Http\Controllers\setting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
class SettingController extends Controller
{
    public function setting(){
        $Setting = Setting::first();
        return view('setting.setting',compact('Setting'));
    }
    public function update(Request $request){
        $message_send = $request->has('message_send');
        $exson_type_naqt = $request->has('exson_type_naqt');
        $exson_type_plastik = $request->has('exson_type_plastik');
        $exson_gibrid = $request->has('exson_gibrid');

        $Setting = Setting::first();
        $Setting->message_send = $message_send?'true':'false';
        if($exson_gibrid==true){
            $Setting->exson_type_naqt = 'true';
            $Setting->exson_type_plastik = 'true';
        }else{
            $Setting->exson_type_naqt = $exson_type_naqt?'true':'false';
            $Setting->exson_type_plastik = $exson_type_plastik?'true':'false';
        }
        $Setting->save();
        return redirect()->back()->with('success', 'Saqlandi');
    }
}
