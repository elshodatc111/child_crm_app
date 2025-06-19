<?php

namespace App\Http\Controllers\hodim;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreVacancyCreateRequest;
use App\Models\Vacancy;

class VacancyController extends Controller{

    public function story(StoreVacancyCreateRequest $request){
        $validates = $request->validated();
        $validates['status'] = 'new';
        $validates['menejer_id'] = auth()->user()->id;
        #dd($validates);
        Vacancy::create($validates);

        return redirect()->back()->with('success', 'Vakansiya muvaffaqiyatli qo‘shildi!');
    }
}
