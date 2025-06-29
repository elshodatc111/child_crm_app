<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditGroupRequest extends FormRequest{
    public function authorize(): bool{
        return true;
    }

    public function rules(): array{
        return [
            'id' => 'required|exists:groups,id',
            'group_name' => 'required|string|max:255',
            'price_month' => 'required|string',
            'price_day' => 'required|string',
            'status' => 'required|in:true,false',
        ];
    }

    public function prepareForValidation(){
        $this->merge([
            'price_month' => str_replace(' ', '', $this->price_month),
            'price_day' => str_replace(' ', '', $this->price_day),
        ]);
    }
}
