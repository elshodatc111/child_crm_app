<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VacancyChild extends Model
{
    protected $fillable = [
        'name',
        'addres',
        'birthday',
        'phone1',
        'phone2',
        'description',
        'status',
        'menejer_id'
    ];
}
