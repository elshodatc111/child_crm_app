<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PaymartChild extends Model
{
    use HasFactory;

    protected $fillable = ['child_id', 'child_parent_id', 'amount', 'type', 'description', 'status', 'user_id'];

    public function child() { return $this->belongsTo(Child::class); }
    public function parent() { return $this->belongsTo(ChildParent::class, 'child_parent_id'); }
    public function user() { return $this->belongsTo(User::class); }
}
