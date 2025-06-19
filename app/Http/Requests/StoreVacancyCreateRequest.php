<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVacancyCreateRequest extends FormRequest{
    public function authorize(): bool{
        return true; 
    }

    public function rules(): array{
        return [
            'fio'        => 'required|string|max:255',
            'phone'      => 'required|string',
            'address'    => 'required|string|max:255',
            'tkun'       => 'required|date|before:today',
            'type'       => 'required|in:meneger,tarbiyachi,techer,bogbon,oshpaz,qarovul,farrosh',
            'description'=> 'required|string|max:1000',
        ];
    }

    public function messages(): array{
        return [
            'fio.required'        => 'FIO kiritilishi shart.',
            'phone.required'      => 'Telefon raqami kiritilishi shart.',
            'phone.regex'         => 'Telefon raqami +998XXXXXXXXX formatda bo‘lishi kerak.',
            'address.required'    => 'Yashash manzili kiritilishi shart.',
            'tkun.required'       => 'Tug‘ilgan kun kiritilishi shart.',
            'tkun.before'         => 'Tug‘ilgan kun hozirgi kundan oldin bo‘lishi kerak.',
            'type.required'       => 'Lavozim tanlanishi shart.',
            'type.in'             => 'Noto‘g‘ri lavozim tanlandi.',
            'description.required'=> 'Vakansiya haqida maʼlumot shart.',
        ];
    }
}
