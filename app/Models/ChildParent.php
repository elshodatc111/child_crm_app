<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ChildParent extends Model
{
    use HasFactory;

    protected $fillable = ['child_id', 'name', 'phone'];

    public function child() { return $this->belongsTo(Child::class); }
    public function childParent(){return $this->belongsTo(ChildParent::class, 'child_parent_id');}
    public function user(){return $this->belongsTo(User::class, 'user_id');}
}
