<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vacancy;
use App\Models\User;
use App\Models\VacancyComment;
use Illuminate\Support\Facades\Hash;

class HodimVacancyController extends Controller{

    public function index(){
        $res = Vacancy::orderBy('id', 'desc')->get();
        $vacancy = $res->map(function ($value) {
            return [
                'id' => $value->id,
                'fio' => $value->fio,
                'type' => $value->type,
                'status' => $value->status,
            ];
        });
        return response()->json([
            'success' => true,
            'result' => $vacancy,
            'message' => "Barcha vakansiyalar",
        ]);
    }

    public function show($id){
        $vacancy = Vacancy::find($id);
        if (!$vacancy) {
            return response()->json([
                'success' => false,
                'message' => "Vakansiya topilmadi",
            ], 404);
        }
        $about = [
            'id' => $vacancy->id,
            'name' => $vacancy->fio,
            'phone' => $vacancy->phone,
            'address' => $vacancy->address,
            'tkun' => $vacancy->tkun,
            'type' => $vacancy->type,
            'status' => $vacancy->status,
            'description' => $vacancy->description,
            'menejer' => optional(User::find($vacancy->menejer_id))->fio,
        ];
        $comments = VacancyComment::where('vacancy_id', $id)->get();
        $res = [];
        foreach($comments as $key => $comment){
            $res[$key]['description'] = $comment->description;
            $res[$key]['meneger'] = User::find($comment->meneger_id)->fio;
            $res[$key]['created_at'] = $comment->created_at->format('Y-m-d H:i');
        }
        return response()->json([
            'success' => true,
            'about' => $about,
            'comment' => $res,
            'message' => "Vakansiya haqida",
        ]);
    }

    public function create_comment(Request $request){
        $request->validate([
            'vacancy_id' => 'required|exists:vacancies,id',
            'description' => 'required|string',
        ]);
        VacancyComment::create([
            'vacancy_id' => $request->vacancy_id,
            'description' => $request->description,
            'meneger_id' => auth()->id(),
        ]);
        $vacancy = Vacancy::find($request->vacancy_id);
        if ($vacancy && $vacancy->status === 'new') {
            $vacancy->status = 'pending';
            $vacancy->save();
        }
        return response()->json([
            'success' => true,
            'message' => "Vakansiyaga izoh qoldirildi",
        ]);
    }

    public function vacancy_cancel(Request $request){
        $request->validate([
            'vacancy_id' => 'required|exists:vacancies,id',
            'description' => 'required|string',
        ]);
        $vacancy = Vacancy::find($request->vacancy_id);
        if (!$vacancy) {
            return response()->json([
                'success' => false,
                'message' => "Vakansiya topilmadi",
            ], 404);
        }
        $vacancy->status = 'cancel';
        $vacancy->save();
        VacancyComment::create([
            'vacancy_id' => $request->vacancy_id,
            'description' => $request->description,
            'meneger_id' => auth()->id(),
        ]);
        return response()->json([
            'success' => true,
            'message' => "Vakansiya bekor qilindi",
        ]);
    }

    public function vacancy_success(Request $request){
        $request->validate([
            'vacancy_id' => 'required|exists:vacancies,id',
            'type' => 'required|string',
            'description' => 'nullable|string',
        ]);
        $vacancy = Vacancy::find($request->vacancy_id);
        if (!$vacancy) {
            return response()->json([
                'success' => false,
                'message' => "Vakansiya topilmadi",
            ], 404);
        }
        $vacancy->status = 'success';
        $vacancy->save();
        VacancyComment::create([
            'vacancy_id' => $request->vacancy_id,
            'description' => $request->description,
            'meneger_id' => auth()->id(),
        ]);
        User::create([
            'fio' => $vacancy->fio,
            'phone' => $vacancy->phone,
            'address' => $vacancy->address,
            'commit' => $request->description,
            'status' => 'active',
            'type' => $request->type,
            'tkun' => $vacancy->tkun,
            'email' => time().'@email.com',
            'password' => Hash::make('password'),
        ]);
        return response()->json([
            'success' => true,
            'message' => "Vakansiya muvaffaqiyatli yakunlandi va foydalanuvchi qo'shildi",
        ]);
    }

    public function create_vacancy(Request $request){
        $validated = $request->validate([
            'fio' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'tkun' => 'nullable|date',
            'type' => 'required|string',
            'description' => 'nullable|string',
        ]);
        $validated['status'] = 'new';
        $validated['menejer_id'] = auth()->id();
        $vacancy = Vacancy::create($validated);
        VacancyComment::create([
            'vacancy_id' => $vacancy->id,
            'description' => "Ro'yxatga olindi",
            'meneger_id' => auth()->id(),
        ]);
        return response()->json([
            'success' => true,
            'message' => "Yangi vakansiya saqlandi",
        ]);
    }

}
