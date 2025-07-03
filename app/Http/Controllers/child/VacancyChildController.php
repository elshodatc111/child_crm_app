<?php

namespace App\Http\Controllers\child;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\VacancyChildRequest;
use App\Models\VacancyChild;
use App\Models\VacancyChildComment;
use App\Models\Group;
use App\Models\Child;
use App\Models\GroupChild;

class VacancyChildController extends Controller{

    public function index(){
        $VacancyChild = VacancyChild::join('users', 'users.id', '=', 'vacancy_children.menejer_id')
            ->orderBy('vacancy_children.id', 'desc')
            ->select('vacancy_children.id','vacancy_children.name','vacancy_children.birthday','vacancy_children.created_at','vacancy_children.status','users.fio')
            ->get();
        return view('child.vakancy',compact('VacancyChild'));
    }

    public function index_create(){
        return view('child.vakancy_create');
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
        $Groups = Group::where('status','true')->get();
        return view('child.vacancy_show',compact('child','comment','Groups'));
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

    public function cancel(Request $request){
        $child = VacancyChild::find($request->vacancy_child_id);
        $child->status = 'cancel';
        $child->save();
        VacancyChildComment::create([
            'vacancy_child_id' => $request->vacancy_child_id,
            'description' => $request->description,
            'meneger' => auth()->user()->fio,
        ]);
        return redirect()->back();
    }
    protected function CreateChild($VacancyChild,$description){
        $Child = Child::create([
            'vacancy_child_id' => $VacancyChild->id,
            'name' => $VacancyChild->name,
            'address' => $VacancyChild->addres,
            'birthday' => $VacancyChild->birthday,
            'phone1' => $VacancyChild->phone1,
            'phone2' => $VacancyChild->phone2,
            'balans' => 0,
            'description' => $description,
            'status' => 'active',
        ]);
        return $Child->id;
    }
    public function success(Request $request){
        $child_id = $request->child_id;
        $group_id = $request->group_id;
        $start_comment = $request->start_comment;
        $paymart_type = $request->paymart_type;
        $VacancyChild = VacancyChild::find($child_id);
        $newChildID = $this->CreateChild($VacancyChild,$start_comment);
        $VacancyChild->status = 'success';
        $VacancyChild->save();
        $VacancyChildComment = VacancyChildComment::create([
            'vacancy_child_id' => $child_id,
            'description' => $start_comment." (Guruhga qo\'shildi)",
            'meneger' => auth()->user()->fio,
        ]);
        $GroupChild = GroupChild::create([
            'group_id' => $group_id,
            'child_id' => $newChildID,
            'start_time' => date('Y-m-d'),
            'start_comment' => $start_comment,
            'paymart_type' => $paymart_type,
            'status' => 'true',
            'end_manager_id' => auth()->user()->id,
        ]);
        return redirect()->back()->with('success', 'Tashrif muvaffaqiyatli saqlandi!');
    }

}
