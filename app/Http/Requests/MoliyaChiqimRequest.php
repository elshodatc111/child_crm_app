<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MoliyaChiqimRequest extends FormRequest
{
    public function authorize(): bool{
        return true; // kerak bo'lsa, faqat adminlar uchun true/false qilish mumkin
    }

    public function rules(): array{
        return [
            'amount'         => ['required', 'string'],
            'status'         => ['required', 'in:balans_naqt_xarajat,balans_plastik_xarajat,balans_naqt_exson,balans_plastik_exson,balans_naqt_daromad,balans_plastik_daromad'],
            'start_comment'  => ['required', 'string', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            'amount.required'        => 'Chiqim summasini kiriting.',
            'amount.regex'           => 'Chiqim summasi noto‘g‘ri formatda.',
            'status.required'        => 'Chiqim turini tanlang.',
            'status.in'              => 'Chiqim turi noto‘g‘ri.',
            'start_comment.required' => 'Izoh maydoni to‘ldirilishi shart.',
        ];
    }
}
