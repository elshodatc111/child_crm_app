<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $fillable = ['group_name', 'price_month', 'price_day', 'status', 'user_id'];

    public function user() { return $this->belongsTo(User::class); }
}
