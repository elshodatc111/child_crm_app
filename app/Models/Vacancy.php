<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vacancy extends Model{
    use HasFactory;
    protected $fillable = [
        'fio',
        'phone',
        'address',
        'tkun',
        'type',
        'status',
        'description',
        'user_id',
        'menejer_id',
    ];
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
    public function menejer(){
        return $this->belongsTo(User::class, 'menejer_id');
    }
}
