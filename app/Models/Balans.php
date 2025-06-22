<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Balans extends Model
{
    protected $fillable = [
        'naqt',
        'plastik',
        'exson_naqt',
        'exson_plastik',
        'exson_foiz',
    ];
}
