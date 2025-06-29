<?php

namespace App\Http\Controllers\hodim;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vacancy;
use App\Models\User;

class HodimController extends Controller{

    public function index(){
        $res = [];
        $res['meneger'] = User::whereIn('type', ['direktor', 'meneger'])->whereIn('status', ['active','block'])->get();
        return view('hodim.index',compact('res'));
    }

    public function hodim_tarbiyachi(){
        $res = [];
        $res['tarbiyachi'] = User::whereIn('type', ['tarbiyachi', 'kichik_tarbiyachi'])->whereIn('status', ['active','block'])->get();
        return view('hodim.tarbiyachi',compact('res'));
    }

    public function hodim_oshpazlar(){
        $res = [];
        $res['oshpaz'] = User::where('type', 'oshpaz')->whereIn('status', ['active','block'])->get();
        return view('hodim.oshpaz',compact('res'));
    }

    public function hodim_boshqalar(){
        $res = [];
        $res['hodim'] = User::whereNotIn('type', ['tarbiyachi', 'kichik_tarbiyachi', 'direktor', 'meneger', 'oshpaz'])->whereIn('status', ['active','block'])->get();
        return view('hodim.boshqa_hosimlar',compact('res'));
    }

    public function hodim_vacancy(){
        $res = [];
        $res['vacancy'] = Vacancy::orderBy('id', 'desc')->get();
        return view('hodim.hodim_vacancy',compact('res'));
    }

    public function hodim_vacancy_show($id){
        $Vacancy = Vacancy::find($id);
        $about = [
            'id' => $Vacancy->id,
            'name' => $Vacancy->fio,
            'phone' => $Vacancy->phone,
            'address' => $Vacancy->address,
            'tkun' => $Vacancy->tkun,
            'type' => $Vacancy->type,
            'status' => $Vacancy->status,
            'description' => $Vacancy->description,
            'menejer' => User::find($Vacancy->menejer_id)->fio,
        ];
        return view('hodim.hodim_vacancy_show',compact('about'));
    }

    public function hodim_vakancy_create(){
        return view('hodim.create_vacancy');
    }

}
