<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\VacancyChild;
use App\Models\VacancyChildComment;
use App\Models\Group;
use App\Models\GroupChild;
use App\Models\Child;
use Carbon\Carbon;

class ChildTashrifController extends Controller
{
    public function index()
    {
        $VacancyChildren = VacancyChild::join('users', 'users.id', '=', 'vacancy_children.menejer_id')
            ->orderBy('vacancy_children.id', 'desc')
            ->select('vacancy_children.id', 'vacancy_children.name', 'vacancy_children.birthday', 'vacancy_children.created_at', 'vacancy_children.status', 'users.fio')
            ->get();

        $res = [];
        foreach ($VacancyChildren as $key => $value) {
            $res[$key] = [
                'id' => $value->id,
                'name' => $value->name,
                'status' => $value->status,
            ];
        }

        return response()->json([
            'success' => true,
            'users' => $res,
            'message' => "Tashriflar",
        ], 200);
    }

    public function create(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'phone1' => 'required|string',
            'phone2' => 'nullable|string',
            'birthday' => 'required|date',
            'addres' => 'required|string',
            'description' => 'required|string',
        ]);

        $validated['menejer_id'] = auth()->user()->id;

        $VacancyChild = VacancyChild::create($validated);

        VacancyChildComment::create([
            'vacancy_child_id' => $VacancyChild->id,
            'description' => "Ro'yhatga olindi",
            'meneger' => auth()->user()->fio,
        ]);

        return response()->json([
            'success' => true,
            'users' => $VacancyChild,
            'message' => "Yangi tashrif saqlandi",
        ], 200);
    }

    public function show($id)
    {
        $child = VacancyChild::find($id);
        if (!$child) {
            return response()->json([
                'success' => false,
                'message' => "Tashrif topilmadi",
            ], 404);
        }

        $chils_about = [
            'id' => $child->id,
            'name' => $child->name,
            'addres' => $child->addres,
            'phone1' => $child->phone1,
            'phone2' => $child->phone2,
            'description' => $child->description,
            'meneger' => User::find($child->menejer_id)->fio ?? 'Noma\'lum',
            'created_at' => Carbon::parse($child->created_at)->format('Y-m-d H:i')
        ];

        $commentList = VacancyChildComment::where('vacancy_child_id', $id)->get();
        $comments = [];
        foreach ($commentList as $key => $value) {
            $comments[$key] = [
                'id' => $value->id,
                'description' => $value->description,
                'meneger' => $value->meneger,
                'created_at' => Carbon::parse($value->created_at)->format('Y-m-d H:i')
            ];
        }

        $groupList = Group::where('status', 'true')->get();
        $groups = [];
        foreach ($groupList as $key => $value) {
            $groups[$key] = [
                'group_id' => $value->id,
                'group_name' => $value->group_name,
                'price_month' => $value->price_month,
                'price_day' => $value->price_day,
            ];
        }

        return response()->json([
            'success' => true,
            'user' => $chils_about,
            'comments' => $comments,
            'groups' => $groups,
            'message' => "Tashrif haqida",
        ], 200);
    }

    public function create_comment(Request $request)
    {
        $validated = $request->validate([
            'vacancy_child_id' => 'required|exists:vacancy_children,id',
            'description' => 'required|string',
        ]);

        $child = VacancyChild::find($validated['vacancy_child_id']);
        if ($child->status == 'new') {
            $child->status = 'pedding';
            $child->save();
        }

        VacancyChildComment::create([
            'vacancy_child_id' => $validated['vacancy_child_id'],
            'description' => $validated['description'],
            'meneger' => auth()->user()->fio,
        ]);

        return response()->json([
            'success' => true,
            'message' => "Kommentariy saqlandi",
        ], 200);
    }

    public function cancel(Request $request)
    {
        $validated = $request->validate([
            'vacancy_child_id' => 'required|exists:vacancy_children,id',
            'description' => 'required|string',
        ]);

        $child = VacancyChild::find($validated['vacancy_child_id']);
        $child->status = 'cancel';
        $child->save();

        VacancyChildComment::create([
            'vacancy_child_id' => $validated['vacancy_child_id'],
            'description' => $validated['description'],
            'meneger' => auth()->user()->fio,
        ]);

        return response()->json([
            'success' => true,
            'message' => "Tashrif bekor qilindi",
        ], 200);
    }

    protected function CreateChild($VacancyChild, $description)
    {
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
            'end_manager_id' => auth()->user()->id,
        ]);

        return $Child->id;
    }

    public function success(Request $request)
    {
        $validated = $request->validate([
            'child_id' => 'required|exists:vacancy_children,id',
            'group_id' => 'required|exists:groups,id',
            'start_comment' => 'required|string',
            'paymart_type' => 'required|string',
        ]);

        $VacancyChild = VacancyChild::find($validated['child_id']);
        $newChildID = $this->CreateChild($VacancyChild, $validated['start_comment']);

        $VacancyChild->status = 'success';
        $VacancyChild->save();

        VacancyChildComment::create([
            'vacancy_child_id' => $validated['child_id'],
            'description' => $validated['start_comment'] . " (Guruhga qo'shildi)",
            'meneger' => auth()->user()->fio,
        ]);

        GroupChild::create([
            'group_id' => $validated['group_id'],
            'child_id' => $newChildID,
            'start_time' => now()->format('Y-m-d'),
            'start_comment' => $validated['start_comment'],
            'paymart_type' => $validated['paymart_type'],
            'status' => 'true',
            'start_manager_id' => auth()->user()->id,
        ]);

        return response()->json([
            'success' => true,
            'message' => "Tashrif muvaffaqiyatli yakunlandi!",
        ], 200);
    }
}
