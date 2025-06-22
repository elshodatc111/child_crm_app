<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'message_send',
        'exson_type_naqt',
        'exson_type_plastik',
    ];
}
