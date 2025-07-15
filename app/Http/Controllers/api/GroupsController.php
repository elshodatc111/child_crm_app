<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Group;
use App\Models\GroupsTarbiyachi;
use App\Models\GroupChild;
use App\Models\DamKunlar;
use App\Models\Child;
use App\Models\ChildDavomad;
use App\Models\Darslar;
use Carbon\Carbon;

class GroupsController extends Controller{
    // Faol guruhlar
    public function index(){
        $groups = Group::where('status', true)->get();
        $data = [];
        foreach ($groups as $key => $value) {
            $data[$key]['id'] = $value->id;
            $data[$key]['name'] = $value->name;
            $data[$key]['child'] = $value->id;
        }
        return response()->json([
            'success' => true,
            'groups' => $data,
            'message' => "Aktiv guruhlar",
        ]);
    }

    // Guruh haqida
    public function show($id){
        $group = Group::findOrFail($id);
        $tarbiyachi = $this->getTarbiyachi($id, 'tarbiyachi');
        $yordamchi = $this->getTarbiyachi($id, 'kichik_tarbiyachi');
        $IshKun = $this->getIshKunlar($group);
        $bugun = date("Y-m-d");
        $DavomadDay = in_array($bugun, array_column($IshKun, 'sanasi')) ? 'true' : 'false';
        $DavomadOlindimi = ChildDavomad::where('group_id', $id)->where('data', now()->toDateString())->exists();
        $davomad = false;
        if($DavomadDay == 'true'){
            if($DavomadOlindimi == false){
                $davomad = true;
            }
        }
        return response()->json([
            'success' => true,
            'about' => [
                'group_id' => $group->id,
                'group_name' => $group->group_name,
                'price_month' => $group->price_month,
                'price_day' => $group->price_day,
                'status' => $group->status,
                'group_type' => $group->group_type,
                'meneger' => optional(User::find($group->user_id))->fio,
                'created_at' => $group->created_at,
                'tarbiyachi_id' => optional($tarbiyachi)->id,
                'tarbiyachi' => optional($tarbiyachi)->fio,
                'yordamchi_id' => optional($yordamchi)->id,
                'yordamchi' => optional($yordamchi)->fio,
            ],
            'ish_kunlar' => $IshKun,
            'davomad_status' => $davomad,
            'message' => "Guruh haqida",
        ]);
    }

    // Guruh bolalari
    public function show_child($id){
        $groupChildren = GroupChild::where('group_id', $id)->get();
        $children = $groupChildren->map(function ($item) {
            $child = Child::find($item->child_id);
            return [
                'id' => $item->child_id,
                'child' => optional($child)->name,
                'balans' => optional($child)->balans,
                'start_time' => $item->start_time,
                'start_comment' => $item->start_comment,
                'start_manejer' => optional(User::find($item->start_manager_id))->fio,
                'end_time' => $item->end_manager_id ? $item->end_time : '',
                'end_comment' => $item->end_manager_id ? $item->end_comment : '',
                'paymart_type' => $item->paymart_type,
                'status' => $item->status,
                'end_manejer' => $item->end_manager_id ? optional(User::find($item->end_manager_id))->fio : '',
            ];
        });
        $tarbiyachilar = GroupsTarbiyachi::where('group_id', $id)->get()->map(function ($item) {
            return [
                'tarbiyachi' => optional(User::find($item->user_id))->fio,
                'start_time' => $item->start_time,
                'end_time' => $item->end_time,
                'type' => $item->type,
                'status' => $item->status,
            ];
        });
        return response()->json([
            'success' => true,
            'child' => $children,
            'tarbiyachi' => $tarbiyachilar,
            'message' => "Guruh bolalar va tarbiyachilar tarixi",
        ]);
    }

    // Joriy va o'tgan oy davomad
    public function show_davomad($id){
        return response()->json([
            'success' => true,
            'id' => $id,
            'child' => $this->joriyOyDavomad($id),
            'otganOy' => $this->otganOyDavomad($id),
            'message' => "Joriy va o'tgan oy davomadi",
        ]);
    }

    // Guruh darslari
    public function show_darslar($id){
        $darslar = Darslar::where('group_id', $id)->get()->map(function ($item) {
            return [
                'techer' => optional(User::find($item->teacher_id))->fio,
                'dars' => $item->lesson_name,
                'count' => $item->child_count,
                'meneger' => optional(User::find($item->user_id))->fio,
                'created_at' => $item->created_at,
            ];
        });
        return response()->json([
            'success' => true,
            'id' => $id,
            'darslar' => $darslar,
            'message' => "Darslar tarixi",
        ]);
    }

    // === YORDAMCHI METODLAR ===

    protected function getTarbiyachi($group_id, $type){
        return GroupsTarbiyachi::where('group_id', $group_id)
            ->join('users', 'users.id', 'groups_tarbiyachis.user_id')
            ->where('users.type', $type)
            ->where('users.status', 'active')
            ->where('groups_tarbiyachis.status', 1)
            ->select('users.id', 'users.fio')
            ->first();
    }

    protected function getIshKunlar($group){
        $month = now()->month;
        $year = now()->year;
        $group_type = $group->group_type === 'besh' ? 5 : 6;
        $hafta_kunlari = [
            1 => 'Dushanba',
            2 => 'Seshanba',
            3 => 'Chorshanba',
            4 => 'Payshanba',
            5 => 'Juma',
            6 => 'Shanba',
            7 => 'Yakshanba',
        ];
        $dam_kunlar = DamKunlar::whereYear('data', $year)->whereMonth('data', $month)->pluck('data')->toArray();
        $days = [];
        $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        for ($day = 1; $day <= $daysInMonth; $day++) {
            $date = Carbon::create($year, $month, $day);
            if ($date->dayOfWeekIso <= $group_type && !in_array($date->toDateString(), $dam_kunlar)) {
                $days[] = [
                    'sanasi' => $date->toDateString(),
                    'hafta_kuni' => $hafta_kunlari[$date->dayOfWeekIso],
                ];
            }
        }
        return $days;
    }

    protected function joriyOyDavomad($group_id){
        $group = Group::findOrFail($group_id);
        $type = $group->group_type === 'besh' ? 5 : 6;
        $startDate = Carbon::now()->startOfMonth();
        $endDate = Carbon::now()->endOfMonth();
        $dam_kunlar = DamKunlar::pluck('data')->toArray();
        $workingDays = [];
        for ($date = $startDate->copy(); $date <= $endDate; $date->addDay()) {
            if ($date->dayOfWeekIso <= $type && !in_array($date->toDateString(), $dam_kunlar)) {
                $workingDays[] = $date->format('m-d');
            }
        }
        return $this->davomadNatijasi($group_id, $workingDays);
    }

    protected function otganOyDavomad($group_id){
        $group = Group::findOrFail($group_id);
        $type = $group->group_type === 'besh' ? 5 : 6;
        $startDate = now()->subMonth()->startOfMonth();
        $endDate = now()->subMonth()->endOfMonth();
        $dam_kunlar = DamKunlar::pluck('data')->toArray();
        $workingDays = [];
        for ($date = $startDate->copy(); $date <= $endDate; $date->addDay()) {
            if ($date->dayOfWeekIso <= $type && !in_array($date->toDateString(), $dam_kunlar)) {
                $workingDays[] = $date->format('m-d');
            }
        }
        return $this->davomadNatijasi($group_id, $workingDays);
    }

    protected function davomadNatijasi($group_id, $days){
        $children = GroupChild::where('group_id', $group_id)->get();
        $result = [];
        foreach ($children as $item) {
            $child = Child::find($item->child_id);
            $natija = [];
            foreach ($days as $date) {
                $fullDate = date('Y') . '-' . $date;
                $record = ChildDavomad::where('child_id', $item->child_id)
                    ->where('group_id', $group_id)
                    ->where('data', $fullDate)
                    ->first();
                $natija[$date] = $record ? $record->status : (Carbon::parse($fullDate)->gt(now()) ? 'kutilmoqda' : 'Olinmadi');
            }
            $result[] = [
                'child_id' => $item->child_id,
                'child_name' => optional($child)->name,
                'natija' => $natija,
            ];
        }
        return [
            'childs' => $result,
            'days' => $days,
        ];
    }

    // Create Davomad
    protected function getWorkingDays($type){
        $days = [];
        $year = date('Y');
        $month = date('m');
        $startDate = strtotime("$year-$month-01");
        $endDate = strtotime(date("Y-m-t", $startDate));
        for ($date = $startDate; $date <= $endDate; $date = strtotime('+1 day', $date)) {
            $dayOfWeek = date('N', $date);
            if ($dayOfWeek >= 1 && $dayOfWeek <= $type) {
                $days[] = date('Y-m-d', $date);
            }
        }
        $i = 0;
        foreach ($days as $value) {
            $DamKunlar = DamKunlar::where('data', $value)->first();
            if (!$DamKunlar) {
                $i++;
            }
        }
        return $i;
    }
    protected function IshKunlarSoni($group_type){
        if($group_type == 'besh'){
            return $this->getWorkingDays(5);
        } else {
            return $this->getWorkingDays(6);
        }
    }
    public function create_davomad(Request $request){
        $request->validate([
            'group_id' => 'required|exists:groups,id',
            'attendance' => 'required|array',
            'attendance.*' => 'in:keldi,kelmadi'
        ]);
        $group_id = $request->group_id;
        $attendances = $request->attendance;
        $group = Group::findOrFail($group_id);
        foreach ($attendances as $child_id => $status) {
            $child = Child::find($child_id);
            if (!$child) {
                continue;
            }
            $groupChild = GroupChild::where('child_id', $child_id)
                ->where('group_id', $group_id)
                ->where('status', 'true')
                ->first();
            if (!$groupChild) {
                continue; 
            }
            $exists = ChildDavomad::where('child_id', $child_id)
                ->where('group_id', $group_id)
                ->where('data', now()->toDateString())
                ->exists();
            if ($exists) {
                continue;
            }
            if ($groupChild->paymart_type === 'day') {
                $pay = $status === 'keldi' ? $group->price_day : 0;
            } else {
                $dayCount = $this->IshKunlarSoni($groupChild->group_type);
                $pay = $dayCount > 0 ? ($group->price_month / $dayCount) : 0;
            }
            $child->balans = max(0, $child->balans - $pay);
            $child->save();
            ChildDavomad::create([
                'child_id' => $child_id,
                'group_id' => $group_id,
                'data' => now()->toDateString(),
                'amount' => $pay,
                'status' => $status,
                'user_id' => auth()->id(),
            ]);
        }
        return response()->json([
            'success' => true,
            'message' => "Guruh davomadi saqlandi.",
        ]);
    }



}
