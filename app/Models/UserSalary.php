<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSalary extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'amount',
        'type',
        'comment',
        'meneger_id',
    ];

    /**
     * Hodim (maosh oluvchi) bilan bog‘lanish
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Menejer bilan bog‘lanish
     */
    public function meneger()
    {
        return $this->belongsTo(User::class, 'meneger_id');
    }
}
