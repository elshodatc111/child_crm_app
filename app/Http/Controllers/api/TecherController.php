<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Balans;
use App\Models\Group;
use App\Models\Darslar;
use App\Models\BalansHistory;
use App\Models\UserSalary;
use App\Models\UserComment;
use Carbon\Carbon;

class TecherController extends Controller{
    
    public function index(){
        $teachers = User::where('type', 'techer')->get();
        $res = [];
        foreach ($teachers as $key => $value) {
            $res[$key]['id'] = $value->id;
            $res[$key]['fio'] = $value->fio;
            $res[$key]['phone'] = $value->phone;
            $res[$key]['address'] = $value->address;
            $res[$key]['status'] = $value->status;
        }
        return response()->json([
            'success' => true,
            'teachers' => $res,
            'message' => "O'qituvchilar ro'yxati",
        ], 200);
    }

    protected function getPayments($id){
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();
        return UserSalary::where('user_id', $id)
            ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
            ->sum('amount');
    }

    protected function getLessonStats($id){
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        $lessons = Darslar::where('teacher_id', $id)
            ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
            ->get();

        return [
            'darslar' => $lessons->count(),
            'child' => $lessons->sum('child_count'),
        ];
    }

    public function show($id){
        $teacher = User::find($id);
        if (!$teacher) {
            return response()->json([
                'success' => false,
                'message' => "O'qituvchi topilmadi.",
            ], 404);
        }
        $comments = UserComment::where('user_id', $id)->get();
        $payments = $this->getPayments($id);
        $lessonStats = $this->getLessonStats($id);
        return response()->json([
            'success' => true,
            'UserComment' => $comments,
            'about' => $teacher,
            'tulov' => $payments,
            'count' => $lessonStats,
            'message' => "O'qituvchi haqida ma'lumot",
        ], 200);
    }

    public function show_lessin($id){
        $lessons = Darslar::where('teacher_id', $id)->get();
        $res = $lessons->map(function ($lesson) {
            return [
                'id' => $lesson->id,
                'group_name' => optional(Group::find($lesson->group_id))->group_name ?? 'Noma’lum',
                'lesson_name' => $lesson->lesson_name,
                'child_count' => $lesson->child_count,
                'meneger' => optional(User::find($lesson->user_id))->fio ?? 'Noma’lum',
                'created_at' => $lesson->created_at,
            ];
        });
        return response()->json([
            'success' => true,
            'res' => $res,
            'message' => "O'qituvchining darslari",
        ], 200);
    }

    public function create_comment(Request $request){
        $request->validate([
            'id' => 'required|exists:users,id',
            'comment' => 'required|string|max:1000',
        ]);
        UserComment::create([
            'user_id' => $request->id,
            'comment' => $request->comment,
            'meneger' => auth()->user()->fio,
        ]);
        return response()->json([ ///sdfsd
            'success' => true,
            'message' => "Izoh muvaffaqiyatli qo'shildi.",
        ], 200);
    }

    public function create_lessin(Request $request){
        $request->validate([
            'group_id' => 'required|exists:groups,id',
            'techer_id' => 'required|exists:users,id',
            'lesson_name' => 'required|string|max:255',
            'child_count' => 'required|integer|min:1',
        ]);
        Darslar::create([
            'group_id' => $request->group_id,
            'teacher_id' => $request->techer_id,
            'lesson_name' => $request->lesson_name,
            'child_count' => $request->child_count,
            'user_id' => auth()->id(),
        ]);
        return response()->json([
            'success' => true,
            'message' => "Yangi dars qo'shildi.",
        ], 200);
    }

}
