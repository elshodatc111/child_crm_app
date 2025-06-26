<?php

namespace App\Http\Controllers\moliya;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Balans;
use App\Models\BalansHistory;
use Carbon\Carbon;

use App\Http\Requests\MoliyaChiqimRequest;

class MoliyaController extends Controller{

    public function index(){
        $Balans = Balans::first();

        $recentHistories = BalansHistory::where('balans_histories.created_at', '>=', Carbon::now()->subDays(45))
            ->join('users','balans_histories.end_user_id','users.id')
            ->select('users.fio','balans_histories.status','balans_histories.amount','balans_histories.start_comment','balans_histories.created_at')
            ->where('balans_histories.type','true')
            ->orderBy('balans_histories.created_at', 'desc')->get();
        return view('moliya.moliya',compact('Balans','recentHistories'));
    }
    protected function checkBalans($amount, $status){
        $balans = Balans::first();
        $map = [
            'balans_naqt_xarajat'     => $balans->naqt,
            'balans_plastik_xarajat'  => $balans->plastik,
            'balans_naqt_exson'       => $balans->exson_naqt,
            'balans_plastik_exson'    => $balans->exson_plastik,
            'balans_naqt_daromad'     => $balans->naqt,
            'balans_plastik_daromad'  => $balans->plastik,
        ];
        if (!array_key_exists($status, $map)) {
            return true;
        }
        if ($map[$status] < $amount) {
            return true;
        }
        return false;
    }

    protected function BalansUpdate($amount, $status){
        $balans = Balans::first();
        $statusFieldMap = [
            'balans_naqt_xarajat'     => 'naqt',
            'balans_naqt_daromad'     => 'naqt',
            'balans_plastik_xarajat'  => 'plastik',
            'balans_plastik_daromad'  => 'plastik',
            'balans_naqt_exson'       => 'exson_naqt',
            'balans_plastik_exson'    => 'exson_plastik',
        ];
        if (!array_key_exists($status, $statusFieldMap)) {
            abort(400, 'Noto‘g‘ri balans statusi!');
        }
        $field = $statusFieldMap[$status];
        $balans->$field -= $amount;
        $balans->save();
        return null;
    }

    public function store(MoliyaChiqimRequest $request){
        if($this->checkBalans((int) str_replace(',', '', $request->amount), $request->status)){
            return redirect()->back()->with('error', 'Balansda yetarli mablag‘ mavjud emas!');
        }
        $this->BalansUpdate((int) str_replace(',', '', $request->amount), $request->status);
        BalansHistory::create([
            'status' => $request->status,
            'type' => 'true',
            'amount' =>(int) str_replace(',', '', $request->amount),
            'start_comment' => $request->start_comment,
            'start_user_id' => null,
            'end_comment' => null,
            'end_user_id' => auth()->user()->id
        ]);
        return redirect()->back()->with('success', 'Chiqim qilindi!');
    }

}
