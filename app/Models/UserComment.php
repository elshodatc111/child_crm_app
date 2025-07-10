<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserComment extends Model
{

    use HasFactory;

    protected $fillable = [
        'user_id',
        'comment',
        'meneger',
    ];

    /**
     * User bilan bog‘lanish
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
