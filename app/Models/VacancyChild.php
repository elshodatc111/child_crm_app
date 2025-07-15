<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VacancyChild extends Model
{
    protected $fillable = [
        'name',
        'addres',
        'birthday',
        'phone1',
        'phone2',
        'description',
        'status',
        'menejer_id'
    ];
    public function comments(){
        return $this->hasMany(VacancyChildComment::class);
    }
    public function meneger(){
        return $this->belongsTo(User::class, 'meneger_id');
    }
    
}
