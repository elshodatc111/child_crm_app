<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vacancy;
use App\Models\User;
use App\Models\HodimDavomad;
use App\Models\PaymartChild;
use App\Models\UserComment;
use App\Models\Balans;
use App\Models\BalansHistory;
use App\Models\UserSalary;

class HodimDavomadController extends Controller{

    public function index(){
        $res = User::whereIn('type', ['menejer','tarbiyachi','kichik_tarbiyachi','oshpaz','hodim'])->where('status', 'active')->get();
        $result = [];
        $now = date("Y-m-d");
        foreach ($res as $key => $value) {
            $result[$key]['user_id'] = $value->id;
            $result[$key]['username'] = $value->fio;
            $result[$key]['type'] = $value->type;
            $davomad = HodimDavomad::where('user_id', $value->id)->where('date', $now)->first();
            $result[$key]['davomad'] = $davomad ? $davomad->status : "olinmadi";
        }
        return response()->json([
            'success' => true,
            'result' => $result,
            'message' => "Hodimlarning bugungi davomad holati",
        ]);
    }

    public function create_davomad(Request $request){
        $statuses = $request->input('statuses');
        $today = date('Y-m-d');
        $davomad = [];
        $key = 0;
        foreach ($statuses as $userId => $status) {
            HodimDavomad::updateOrCreate(
                [
                    'user_id' => $userId,
                    'date' => $today
                ],
                [
                    'status' => $status
                ]
            );
        }
        return response()->json([
            'success' => true,
            'message' => "Davomad muvaffaqiyatli saqlandi!",
        ]);
    }

}
