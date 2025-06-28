<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GroupsTarbiyachi extends Model
{
    use HasFactory;

    protected $fillable = ['group_id', 'user_id', 'start_time', 'end_time', 'type', 'status'];

    public function group() { return $this->belongsTo(Group::class); }
    public function user() { return $this->belongsTo(User::class); }
}
