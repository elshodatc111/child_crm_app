<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kassa extends Model
{
    protected $fillable = [
        'naqt',
        'naqt_chiqim',
        'naqt_xarajat',
        'plastik',
        'plastik_chiqim',
        'plastik_xarajat',
    ];
}
