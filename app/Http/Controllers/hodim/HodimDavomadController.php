<?php

namespace App\Http\Controllers\hodim;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\HodimDavomad;
use Carbon\Carbon;
use App\Http\Requests\DavomadMenegerRequest;

class HodimDavomadController extends Controller{

    protected function ish_kunlari(){
        $dates = [];
        $day = Carbon::today();
        $i = 0;
        while (count($dates) < 30) {
            if (!$day->isSunday()) {
                $dates[$i]['string'] = $day->format('M-d');
                $dates[$i]['data'] = $day->format('Y-m-d');
                $i++;
            }
            $day->subDay();
        }
        return $dates;
    }
    protected function MenegerDavomadJadval($ishKunlar){
        $User = User::where('type','menejer')->where('status','active')->select('id','fio')->get();
        $jadval = [];
        foreach ($User as $key => $value) {
            $jadval[$key]['id'] = $value['id'];
            $jadval[$key]['fio'] = $value['fio'];
            $status = [];
            foreach ($ishKunlar as $key2 => $value2) {
                $HodimDavomad = HodimDavomad::where('user_id',$value['id'])->where('date',$value2)->first();
                if($HodimDavomad){
                    $status[$key2] = $HodimDavomad->status;
                }else{
                    $status[$key2] = 'olinmadi';
                }
            }
            $jadval[$key]['status'] = $status;
        }
        return $jadval;
    }
    protected function MenegerlarDavomadHolati(){
        $User = User::where('type','menejer')->where('status','active')->select('id','fio')->get();
        $jadval = [];
        foreach ($User as $key => $value) {
            $jadval[$key]['id'] = $value['id'];
            $jadval[$key]['fio'] = $value['fio'];
            $HodimDavomad = HodimDavomad::where('user_id',$value['id'])->where('date',date('Y-m-d'))->first();
            if($HodimDavomad){
                $jadval[$key]['status'] = $HodimDavomad->status;
            }else{
                $jadval[$key]['status'] = '';
            }
        }
        return $jadval;
    }
    public function meneger(){
        $kunlar = $this->ish_kunlari();
        $ishString = array_reverse(array_column($kunlar, 'string'));
        $jadval = $this->MenegerDavomadJadval(array_reverse(array_column($kunlar, 'data')));
        $davomad = $this->MenegerlarDavomadHolati();
        return view('hodim.davomad.menejer',compact('ishString','jadval','davomad'));
    }
    public function meneger_davomad_store(DavomadMenegerRequest $request){
        $statuses = $request->input('statuses');
        $today = date('Y-m-d');
        foreach ($statuses as $userId => $status) {
            HodimDavomad::updateOrCreate(
                [
                    'user_id' => $userId,
                    'date' => $today
                ],
                [
                    'status' => $status
                ]
            );
        }
        return redirect()->back()->with('success', 'Davomad muvaffaqiyatli saqlandi!');
    }

    public function tarbiyachi(){
        return view('hodim.davomad.tarbiyachi');
    }

    public function oshpaz(){
        return view('hodim.davomad.oshpaz');
    }

    public function hodim(){
        return view('hodim.davomad.hodim');
    }

}
