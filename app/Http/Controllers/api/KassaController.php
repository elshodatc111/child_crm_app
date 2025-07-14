<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Balans;
use App\Models\BalansHistory;
use App\Models\Kassa;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class KassaController extends Controller{
    // Kassa umumiy ko'rinishi
    public function index(){
        $kassa = Kassa::first();
        $historyItems = BalansHistory::where('type', 'pedding')->get();
        $history = $historyItems->map(function ($item) {
            return [
                'id' => $item->id,
                'status' => $item->status,
                'amount' => $item->amount,
                'start_comment' => $item->start_comment,
                'meneger' => optional(User::find($item->start_user_id))->fio,
                'created_at' => $item->created_at,
            ];
        });

        return response()->json([
            'success' => true,
            'kassa' => $kassa->only([
                'naqt', 'naqt_chiqim', 'naqt_xarajat',
                'plastik', 'plastik_chiqim', 'plastik_xarajat'
            ]),
            'history' => $history,
            'message' => "Kassa ma'lumotlari",
        ]);
    }
    // Kassa chiqim (yoki xarajat) qo'shish
    public function kassa_post(Request $request){
        $validated = $request->validate([
            'expense_type' => 'required|in:chiqim,xarajat',
            'amount' => 'required|string',
            'payment_type' => 'required|in:Naqt,Plastik',
            'note' => 'nullable|string'
        ]);

        $amount = (int) str_replace(',', '', $validated['amount']);
        if ($this->isInsufficientFunds($validated['payment_type'], $amount)) {
            return response()->json([
                'success' => false,
                'message' => "Kassada yetarli mablag' mavjud emas.",
            ], 422);
        }
        $this->createKassaChiqim(
            $validated['expense_type'],
            $amount,
            $validated['payment_type'],
            $validated['note']
        );
        return response()->json([
            'success' => true,
            'message' => "Kassada {$validated['expense_type']} tasdiqlash kutilmoqda!",
        ]);
    }
    // Tasdiqlash
    public function kassa_success(Request $request){
        $history = BalansHistory::findOrFail($request->id);
        $history->update([
            'type' => 'success',
            'end_comment' => 'Tasdiqlandi',
            'end_user_id' => Auth::id(),
        ]);
        $this->applyKassaTasdiq($history);
        return response()->json([
            'success' => true,
            'message' => "So'rov tasdiqlandi.",
        ]);
    }
    // Bekor qilish
    public function kassa_delete(Request $request){
        $history = BalansHistory::findOrFail($request->id);
        $this->rollbackKassa($history);
        $history->update([
            'type' => 'cancel',
            'end_comment' => 'Bekor qilindi.',
            'end_user_id' => Auth::id(),
        ]);
        return response()->json([
            'success' => true,
            'message' => "Tasdiqlanmagan so'rov bekor qilindi.",
        ]);
    }
    // === Helper funksiyalar ===
    protected function isInsufficientFunds($type, $amount){
        $kassa = Kassa::first();
        return match ($type) {
            'Naqt' => $kassa->naqt < $amount,
            'Plastik' => $kassa->plastik < $amount,
        };
    }
    protected function createKassaChiqim($expenseType, $amount, $paymentType, $note){
        $kassa = Kassa::first();
        $status = null;
        if ($expenseType === 'chiqim') {
            $status = $paymentType === 'Naqt' ? 'naqt_chiqim' : 'plastik_chiqim';
        } else {
            $status = $paymentType === 'Naqt' ? 'naqt_xarajat' : 'plastik_xarajat';
        }
        // Update Kassa
        $field = strtolower($paymentType);
        $kassa->$field -= $amount;
        $kassa->{$status} += $amount;
        $kassa->save();
        // Create BalansHistory
        BalansHistory::create([
            'status' => $status,
            'type' => 'pedding',
            'amount' => $amount,
            'start_comment' => $note,
            'start_user_id' => Auth::id(),
        ]);
    }
    protected function applyKassaTasdiq(BalansHistory $history){
        $kassa = Kassa::first();
        $balans = Balans::first();
        $status = $history->status;
        $amount = $history->amount;
        switch ($status) {
            case 'naqt_chiqim':
                $kassa->naqt_chiqim -= $amount;
                $balans->naqt += $amount;
                break;
            case 'plastik_chiqim':
                $kassa->plastik_chiqim -= $amount;
                $balans->plastik += $amount;
                break;
            case 'naqt_xarajat':
                $kassa->naqt_xarajat -= $amount;
                break;
            case 'plastik_xarajat':
                $kassa->plastik_xarajat -= $amount;
                break;
        }
        $kassa->save();
        $balans->save();
    }
    protected function rollbackKassa(BalansHistory $history){
        $kassa = Kassa::first();
        $status = $history->status;
        $amount = $history->amount;
        switch ($status) {
            case 'naqt_chiqim':
                $kassa->naqt_chiqim -= $amount;
                $kassa->naqt += $amount;
                break;
            case 'plastik_chiqim':
                $kassa->plastik_chiqim -= $amount;
                $kassa->plastik += $amount;
                break;
            case 'naqt_xarajat':
                $kassa->naqt_xarajat -= $amount;
                $kassa->naqt += $amount;
                break;
            case 'plastik_xarajat':
                $kassa->plastik_xarajat -= $amount;
                $kassa->plastik += $amount;
                break;
        }
        $kassa->save();
    }
}
