<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GroupChild extends Model{
    use HasFactory;

    protected $fillable = [
        'group_id', 'child_id', 'start_time', 'end_time', 'start_comment', 'end_comment', 'paymart_type', 'start_manager_id', 'end_manager_id', 'status'
    ];

    public function child() { return $this->belongsTo(Child::class); }
    public function group(){return $this->belongsTo(Group::class, 'group_id');}
    public function startManager(){return $this->belongsTo(User::class, 'start_manager_id');}
    public function endManager(){return $this->belongsTo(User::class, 'end_manager_id');}
}
