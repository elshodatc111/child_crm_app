<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ChildComment extends Model
{
    use HasFactory;

    protected $fillable = [
        'child_id',
        'description',
        'user_id',
    ];

    // Aloqalar
    public function child()
    {
        return $this->belongsTo(Child::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
