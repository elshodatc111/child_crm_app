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
    protected function DavomadJadval($ishKunlar, $type){
        $User = User::where('type',$type)->where('status','active')->select('id','fio')->get();
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
    protected function DavomadHolati($type){
        $User = User::where('type',$type)->where('status','active')->select('id','fio')->get();
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
        $jadval = $this->DavomadJadval(array_reverse(array_column($kunlar, 'data')),'menejer');
        $davomad = $this->DavomadHolati('menejer');
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
        return redirect()->back()->with('success', 'Продолжение успешно сохранено!');
    }
    protected function DavomadJadvalTarbiyachi($ishKunlar){
        $types = ['tarbiyachi', 'kichik_tarbiyachi'];
        $User = User::whereIn('type', $types)->where('status', 'active')->select('id', 'fio')->get();
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
    protected function DavomadHolatiTarbiyachi(){
        $types = ['tarbiyachi', 'kichik_tarbiyachi'];
        $User = User::whereIn('type', $types)->where('status','active')->select('id','fio')->get();
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
    public function tarbiyachi(){
        $kunlar = $this->ish_kunlari();
        $ishString = array_reverse(array_column($kunlar, 'string'));
        $jadval = $this->DavomadJadvalTarbiyachi(array_reverse(array_column($kunlar, 'data')));
        $davomad = $this->DavomadHolatiTarbiyachi();
        return view('hodim.davomad.tarbiyachi', compact('ishString','jadval','davomad'));
    }

    public function oshpaz(){
        $kunlar = $this->ish_kunlari();
        $ishString = array_reverse(array_column($kunlar, 'string'));
        $jadval = $this->DavomadJadval(array_reverse(array_column($kunlar, 'data')),'oshpaz');
        $davomad = $this->DavomadHolati('oshpaz');
        return view('hodim.davomad.oshpaz', compact('ishString','jadval','davomad'));
    }

    public function hodim(){
        $kunlar = $this->ish_kunlari();
        $ishString = array_reverse(array_column($kunlar, 'string'));
        $jadval = $this->DavomadJadval(array_reverse(array_column($kunlar, 'data')),'hodim');
        $davomad = $this->DavomadHolati('hodim');
        return view('hodim.davomad.hodim', compact('ishString','jadval','davomad'));
    }

}
