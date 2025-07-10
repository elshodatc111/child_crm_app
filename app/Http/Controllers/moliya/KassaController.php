<?php

namespace App\Http\Controllers\moliya;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Balans;
use App\Models\BalansHistory;
use App\Models\Kassa;
use App\Models\User;
use Carbon\Carbon;

class KassaController extends Controller{

    public function index(){
        $Kassa = Kassa::first();
        $history = BalansHistory::where('type','pedding')->get();
        $res = [];
        foreach ($history as $key => $value) {
            $res[$key]['id'] = $value->id;
            $res[$key]['status'] = $value->status;
            $res[$key]['amount'] = $value->amount;
            $res[$key]['start_comment'] = $value->start_comment;
            $res[$key]['meneger'] = User::find($value->start_user_id)->fio;
            $res[$key]['created_at'] = $value->created_at;
        }
        return view('moliya.kassa',compact('Kassa','res'));
    }

    protected function checkAmount($type,$amount){
        $Kassa = Kassa::first();
        if($type == 'Naqt' AND $Kassa->naqt<$amount){
            return true;
        }
        if($type == 'Plastik' AND $Kassa->plastik<$amount){
            return true;
        }
        return false;
    }

    protected function kassdanChiqim($expense_type, $amount, $payment_type, $note){
        $Kassa = Kassa::first();
        if($expense_type=='chiqim'){
            if($payment_type == 'Naqt'){
                $Kassa->naqt = $Kassa->naqt - $amount;
                $Kassa->naqt_chiqim = $Kassa->naqt_chiqim + $amount;
                $status = 'naqt_chiqim';
            }else{
                $Kassa->plastik = $Kassa->plastik - $amount;
                $Kassa->plastik_chiqim = $Kassa->plastik_chiqim + $amount;
                $status = 'plastik_chiqim';
            }
        }else{
            if($payment_type == 'Naqt'){
                $Kassa->naqt = $Kassa->naqt - $amount;
                $Kassa->naqt_xarajat = $Kassa->naqt_xarajat + $amount;
                $status = 'naqt_xarajat';
            }else{
                $Kassa->plastik = $Kassa->plastik - $amount;
                $Kassa->plastik_xarajat = $Kassa->plastik_xarajat + $amount;
                $status = 'plastik_xarajat';
            }
        }
        $Kassa->save();
        BalansHistory::create([
            'status' => $status,
            'type' => 'pedding',
            'amount' => $amount,
            'start_comment' => $note,
            'start_user_id' => auth()->user()->id,
            'end_comment' => null,
            'end_user_id' => null,
        ]);
        return true;
    }

    public function kassa_chiqim(Request $request){
        $expense_type = $request->expense_type;
        $amount = (int) str_replace(",","",$request->amount);
        $payment_type = $request->payment_type;
        $note = $request->note;
        if($this->checkAmount($payment_type, $amount)){
            return redirect()->back()->with('success', 'Kassada yetarmi mablag\' mavjud emas!');
        }
        $this->kassdanChiqim($expense_type, $amount, $payment_type, $note);
        if($expense_type=="chiqim"){
            return redirect()->back()->with('success', 'Kassada chiqim tashdiqlash kutilmoqda!');
        }
        if($expense_type=="xarajat"){
            return redirect()->back()->with('success', 'Kassada xarajat tashdiqlash kutilmoqda!');
        }
    }

    public function kassa_chiqim_delete(Request $request){
        $BalansHistory = BalansHistory::find($request->id);
        $BalansHistory->type = 'cancel';
        $BalansHistory->end_comment = 'Bekor qilindi.';
        $BalansHistory->end_user_id = auth()->user()->id;
        $BalansHistory->save();
        $status = $BalansHistory->status;
        $amount = $BalansHistory->amount;
        $Kassa = Kassa::first();
        if($status == 'naqt_xarajat'){
            $Kassa->naqt_xarajat = $Kassa->naqt_xarajat-$amount;
            $Kassa->naqt = $Kassa->naqt+$amount;
        }
        if($status == 'naqt_chiqim'){
            $Kassa->naqt_chiqim = $Kassa->naqt_chiqim-$amount;
            $Kassa->naqt = $Kassa->naqt+$amount;
        }
        if($status == 'plastik_chiqim'){
            $Kassa->plastik_chiqim = $Kassa->plastik_chiqim-$amount;
            $Kassa->plastik = $Kassa->plastik+$amount;
        }
        if($status == 'plastik_xarajat'){
            $Kassa->plastik_xarajat = $Kassa->plastik_xarajat-$amount;
            $Kassa->plastik = $Kassa->plastik+$amount;
        }
        $Kassa->save();
        return redirect()->back()->with('success', 'Chiqim bekor qilindi!');
    }

    public function kassa_chiqim_success(Request $request){
        $id = $request->id;
        $BalansHistory = BalansHistory::find($id);
        $BalansHistory->type = 'success';
        $BalansHistory->end_comment = 'Tasdiqlandi';
        $BalansHistory->end_user_id = auth()->user()->id;
        $BalansHistory->save();
        $amount = $BalansHistory->amount;
        $Kassa = Kassa::first();
        $Balans = Balans::first();
        $status = $BalansHistory->status;
        if($status == 'plastik_xarajat'){
            $Kassa->plastik_xarajat = $Kassa->plastik_xarajat - $amount;
        }elseif($status == 'plastik_chiqim'){
            $Balans->plastik = $Balans->plastik + $amount;
            $Kassa->plastik_chiqim = $Kassa->plastik_chiqim - $amount;
        }elseif($status == 'naqt_xarajat'){
            $Kassa->naqt_xarajat = $Kassa->naqt_xarajat - $amount;
        }else{
            $Balans->naqt = $Balans->naqt + $amount;
            $Kassa->naqt_chiqim = $Kassa->naqt_chiqim - $amount;
        }
        $Kassa->save();
        $Balans->save();
        return redirect()->back()->with('success', 'Tasdiqlandi!');
    }

}
