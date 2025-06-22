<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DamKunlar extends Model
{
    protected $fillable = [
        'data',
        'comment',
        'user_id',
    ];
}
