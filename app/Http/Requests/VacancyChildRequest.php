<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VacancyChildRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'phone1' => 'required|string|min:7|max:20',
            'phone2' => 'required|string|min:7|max:20',
            'birthday' => 'required|date|before:today',
            'addres' => 'required|string|max:255',
            'description' => 'required|string|max:500',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'FIO majburiy',
            'phone1.required' => 'Telefon raqam majburiy',
            'phone2.required' => 'Qo‘shimcha telefon raqam majburiy',
            'birthday.required' => 'Tug‘ilgan sana majburiy',
            'addres.required' => 'Yashash manzili majburiy',
            'description.required' => 'Tashrif maqsadi majburiy',
        ];
    }
}
