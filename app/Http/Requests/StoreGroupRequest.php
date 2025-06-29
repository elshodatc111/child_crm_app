<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGroupRequest extends FormRequest{
    public function authorize(): bool{
        return true;
    }

    public function rules(): array{
        return [
            'group_name'   => 'required|string|max:255',
            'price_month'  => 'required|string',
            'price_day'    => 'required|string',
            'user_id1'     => 'required|exists:users,id',
            'user_id2'     => 'required|exists:users,id',
        ];
    }

    public function messages(): array{
        return [
            'group_name.required'  => 'Guruh nomi majburiy.',
            'price_month.required' => 'Oylik to‘lov kiritilishi shart.',
            'price_day.required'   => 'Kunlik to‘lov kiritilishi shart.',
            'user_id1.required'    => 'Katta tarbiyachini tanlang.',
            'user_id2.required'    => 'Kichik tarbiyachini tanlang.',
        ];
    }

    public function prepareForValidation(){
        $this->merge([
            'price_month' => str_replace(' ', '', $this->price_month),
            'price_day'   => str_replace(' ', '', $this->price_day),
        ]);
    }
}
