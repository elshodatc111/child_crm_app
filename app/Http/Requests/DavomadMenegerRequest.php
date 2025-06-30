<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DavomadMenegerRequest extends FormRequest{

    public function authorize(): bool{
        return true;
    }

    public function rules(): array{
        return [
            'statuses' => 'required|array',
            'statuses.*' => 'required|in:present,absent,late,no_uniform,off_day',
        ];
    }

    public function messages(): array{
        return [
            'statuses.required' => 'Davomad holatlari majburiy.',
            'statuses.*.required' => 'Har bir xodim uchun holat tanlanishi kerak.',
            'statuses.*.in' => 'Noto‘g‘ri holat tanlandi.',
        ];
    }
}
