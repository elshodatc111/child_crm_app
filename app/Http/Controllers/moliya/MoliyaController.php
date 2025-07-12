<?php

namespace App\Http\Controllers\moliya;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Balans;
use App\Models\BalansHistory;
use Carbon\Carbon;

use App\Http\Requests\MoliyaChiqimRequest;

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
            $res[$key]['created_at'] = $value->updated_at;
        }
        $recentHistories = [];
        return view('moliya.moliya',compact('Balans','res'));
    }

    public function store(MoliyaChiqimRequest $request){
        $Balans = Balans::first();
        $naqt = $Balans->naqt;
        $plastik = $Balans->plastik;
        $chiqim_amount = (int) str_replace(",","",$request->amount);
        $status = $request->status;
        $comment = $request->start_comment;
        if($status == 'balans_naqt_xarajat' OR $status == 'balans_naqt_daromad'){
            if($naqt<$chiqim_amount){
                return redirect()->back()->with('error', 'Balansda yetarmi mablag\' mavjud emas!');
            }
            $Balans->naqt = $Balans->naqt - $chiqim_amount;
        }
        if($status == 'balans_plastik_xarajat' OR $status == 'balans_plastik_daromad'){
            if($plastik<$chiqim_amount){
                return redirect()->back()->with('error', 'Balansda yetarmi mablag\' mavjud emas!');
            }
            $Balans->plastik = $Balans->plastik - $chiqim_amount;
        }
        $Balans->save();
        BalansHistory::create([
            'status' => $status,
            'type' => 'success',
            'amount' => $chiqim_amount,
            'start_comment' => $comment,
            'start_user_id' => auth()->user()->id,
        ]);
        return redirect()->back()->with('success', 'Tasdiqlandi!');
    }

}
