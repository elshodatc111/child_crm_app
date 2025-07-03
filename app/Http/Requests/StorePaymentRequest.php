<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePaymentRequest extends FormRequest{
    public function authorize()
    {
        return true;
    }

    public function prepareForValidation(){
        $this->merge([
            'amount' => str_replace(' ', '', $this->amount),
        ]);
    }

    public function rules(){
        return [
            'child_id' => 'required',
            'type' => 'required|in:naqt,plastik,qaytar_naqt,qaytar_plastik,chegirma',
            'amount' => 'required',
            'child_parent_id' => 'required',
            'description' => 'required|string|max:1000',
        ];
    }

    public function messages(){
        return [
            'amount.required' => 'To‘lov summasini kiriting.',
            'amount.numeric' => 'To‘lov summasi noto‘g‘ri formatda.',
        ];
    }
}
