<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Child extends Model
{
    use HasFactory;

    protected $fillable = ['vacancy_child_id', 'name', 'address', 'birthday', 'phone1', 'phone2', 'balans', 'description', 'status', 'end_manager_id'];

    public function vacancy() { return $this->belongsTo(VacancyChild::class, 'vacancy_child_id'); }
    public function parents() { return $this->hasMany(ChildParent::class); }
    public function payments() { return $this->hasMany(PaymartChild::class); }
    public function manager(){return $this->belongsTo(User::class, 'end_manager_id');}
    public function groupChild(){return $this->hasOne(GroupChild::class)->where('status', 'true');}
    public function childParents(){return $this->hasMany(ChildParent::class, 'child_id');}
    public function comments(){return $this->hasMany(ChildComment::class, 'child_id')->with('user');}
}
