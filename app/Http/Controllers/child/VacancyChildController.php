<?php

namespace App\Http\Controllers\child;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\VacancyChildRequest;
use App\Models\VacancyChild;

class VacancyChildController extends Controller
{
    public function index(){
        $VacancyChild = VacancyChild::join('users', 'users.id', '=', 'vacancy_children.menejer_id')->orderBy('vacancy_children.id', 'desc')
        ->select('vacancy_children.id','vacancy_children.name','vacancy_children.birthday','vacancy_children.created_at','vacancy_children.status','users.fio')->get();
        #dd($VacancyChild);
        return view('child.vakancy',compact('VacancyChild'));
    }

    public function store(VacancyChildRequest $request){
        $validates = $request->validated();
        $validates['menejer_id'] = intval(auth()->user()->id);
        VacancyChild::create($validates);
        return redirect()->back()->with('success', 'Tashrif muvaffaqiyatli saqlandi!');
    }
}
