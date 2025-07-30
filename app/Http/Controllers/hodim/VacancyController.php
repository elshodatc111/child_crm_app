<?php

namespace App\Http\Controllers\hodim;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreVacancyCreateRequest;
use App\Models\Vacancy;
use App\Models\User;
use App\Models\VacancyComment;
use Illuminate\Support\Facades\Hash;

class VacancyController extends Controller{

    public function story(StoreVacancyCreateRequest $request){
        $validates = $request->validated();
        $validates['status'] = 'new';
        $validates['menejer_id'] = auth()->user()->id;
        $vacancy_id = Vacancy::create($validates);
        VacancyComment::create([
            'vacancy_id' => $vacancy_id->id,
            'description' => "Ro'yhatga oliondi",
            'meneger_id' => auth()->user()->id,
        ]);
        return redirect()->back()->with('success', 'Вакансия успешно добавлена!');
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
        $commentS = VacancyComment::where('vacancy_id',$id)->get();
        $comment = [];
        foreach ($commentS as $key => $value) {
            $comment[$key]['description'] = $value->description;
            $comment[$key]['meneger'] = User::find($value->meneger_id)->fio;
            $comment[$key]['created_at'] = $value->created_at;
        }
        return view('hodim.hodim_vacancy_show',compact('about','comment'));
    }

    public function story_comment(Request $request){
        VacancyComment::create([
            'vacancy_id' => $request->vacancy_id,
            'description' => $request->description,
            'meneger_id' => auth()->user()->id
        ]);
        $Vacancy = Vacancy::find($request->vacancy_id);
        if($Vacancy->status = 'new'){
            $Vacancy->status = 'pending';
            $Vacancy->save();
        }
        return redirect()->back()->with('success', 'Примечание сохранено!');
    }

    public function hodim_vakancy_create(){
        return view('hodim.create_vacancy');
    }

    public function story_cancel(Request $request){
        $Vacancy = Vacancy::find($request->vacancy_id);
        $Vacancy->status = 'cancel';
        $Vacancy->save();
        VacancyComment::create([
            'vacancy_id' => $request->vacancy_id,
            'description' => $request->description,
            'meneger_id' => auth()->user()->id
        ]);
        return redirect()->back()->with('success', 'Вакансия отменена!');
    }

    public function story_success(Request $request){
        $vacancy_id = $request->vacancy_id;
        $lavozim = $request->type;
        $description = $request->description;
        $Vacancy = Vacancy::find($vacancy_id);
        $Vacancy->status = 'success';
        $Vacancy->save();
        VacancyComment::create([
            'vacancy_id' => $request->vacancy_id,
            'description' => $request->description,
            'meneger_id' => auth()->user()->id
        ]);
        User::create([
            'fio' => $Vacancy->fio,
            'phone' => $Vacancy->phone,
            'address' => $Vacancy->address,
            'commit' => $description,
            'status' => 'active',
            'type' => $lavozim,
            'tkun' => $Vacancy->tkun,
            'email' => time()."@email.com",
            'password' => Hash::make('password'),
        ]);
        return redirect()->back()->with('success', 'Вакансия закрыта!');
    }





}
