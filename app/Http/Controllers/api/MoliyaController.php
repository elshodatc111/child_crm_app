<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Balans;
use App\Models\BalansHistory;
use Carbon\Carbon;

class MoliyaController extends Controller{

    public function index(){
        $Balans = Balans::first();
        $data = Carbon::now()->subDays(45)->toDateString();
        $BalansHistory = BalansHistory::where('created_at','>=',$data." 00:00:00")->where('type','success')->orderby('updated_at','desc')->get();
        $res = [];
        foreach ($BalansHistory as $key => $value) {
            $res[$key]['status'] = $value->status;
            $res[$key]['amount'] = $value->amount;
            $res[$key]['start_comment'] = $value->start_comment;
            $res[$key]['start_user_id'] = User::find($value->start_user_id)->fio;
            $res[$key]['created_at'] = Carbon::parse($value->updated_at)->format('Y-m-d H:i');
        }
        return response()->json([
            'success' => true,
            'naqt' => $Balans->naqt,
            'plastik' => $Balans->plastik,
            'history' => $res,
            'message' => "Moliya",
        ], 200);
    }

}
