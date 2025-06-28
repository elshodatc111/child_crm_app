<?php

namespace App\Http\Controllers\child;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\VacancyChildRequest;
use App\Models\VacancyChild;
use App\Models\VacancyChildComment;

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
        $VacancyChild = VacancyChild::create($validates);
        $id = $VacancyChild->id;
        VacancyChildComment::create([
            'vacancy_child_id' => $id,
            'description' => "Ro'yhatga olindi",
            'meneger' => auth()->user()->fio,
        ]);
        return redirect()->back()->with('success', 'Tashrif muvaffaqiyatli saqlandi!');
    }

    public function show($id){
        $child = VacancyChild::find($id);
        $comment = VacancyChildComment::where('vacancy_child_id',$id)->get();
        return view('child.vacancy_show',compact('child','comment'));
    }

    public function create_comment(Request $request){
        $child = VacancyChild::find($request->vacancy_child_id);
        if($child['status'] == 'new'){
            $child->status = 'pedding';
            $child->save();
        }
        VacancyChildComment::create([
            'vacancy_child_id' => $request->vacancy_child_id,
            'description' => $request->description,
            'meneger' => auth()->user()->fio,
        ]);
        return redirect()->back();
    }
}
