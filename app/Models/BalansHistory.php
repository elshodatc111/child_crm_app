<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BalansHistory extends Model
{
    protected $fillable = [
        'status',
        'type',
        'amount',
        'start_comment',
        'start_user_id',
        'end_comment',
        'end_user_id',
    ];
}
