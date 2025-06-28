<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GroupChild extends Model
{

    use HasFactory;

    protected $fillable = [
        'group_id', 'child_id', 'start_time', 'end_time', 'start_comment', 'end_comment', 'start_manager_id', 'end_manager_id'
    ];

    public function group() { return $this->belongsTo(Group::class); }
    public function child() { return $this->belongsTo(Child::class); }
}
