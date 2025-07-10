<?php

namespace App\Http\Controllers\setting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\Balans;
use App\Models\User;
use App\Models\DamKunlar;

class SettingController extends Controller{

    public function setting(){
        $Setting = Setting::first();
        $Balans = Balans::first();
        $DamKunlar = DamKunlar::orderby('data', 'asc')->get();
        $kun = [];
        foreach ($DamKunlar as $key => $value) {
            $kun[$key]['id'] = $value->id;
            $kun[$key]['comment'] = $value->comment;
            $kun[$key]['user'] = User::find($value->user_id)->fio;
            $kun[$key]['data'] = $value->data;
        }
        return view('setting.setting',compact('Setting','Balans','kun'));
    }

    public function update(Request $request){
        $message_send = $request->has('message_send');
        $Setting = Setting::first();
        $Setting->message_send = $message_send?'true':'false';
        $Setting->save();
        return redirect()->back()->with('success', 'O\'zgarishlar saqlandi');
    }

    public function update_exson(Request $request){
        $exson_foiz = $request->exson_foiz;
        $Setting = Balans::first();
        $Setting->exson_foiz =  $exson_foiz;
        $Setting->save();
        return redirect()->back()->with('success', 'O\'zgarishlar saqlandi');
    }

    public function create_day(Request $request){
        $comment = $request->comment;
        $data = $request->data;
        DamKunlar::create([
            'comment' => $comment,
            'data' => $data,
            'user_id' => auth()->user()->id
        ]);
        return redirect()->back()->with('success', 'Yangi dam olish kuni qo\'shildi!');
    }

    public function delete_day(Request $request){
        $id = $request->id;
        $DamKunlar = DamKunlar::find($id);
        $DamKunlar->delete();
        return redirect()->back()->with('success', 'Dam olish kuni o\'chirildi!');
    }

}
