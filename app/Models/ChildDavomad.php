<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ChildDavomad extends Model
{
    use HasFactory;

    protected $table = 'child_davomads';

    protected $fillable = [
        'child_id',
        'group_id',
        'data',
        'amount',
        'status',
        'user_id',
    ];

    // Bog'lanishlar
    public function child()
    {
        return $this->belongsTo(Child::class);
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
