<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ChildParent extends Model
{
    use HasFactory;

    protected $fillable = ['child_id', 'name', 'phone', 'type'];

    public function child() { return $this->belongsTo(Child::class); }
}
