<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable{

    use HasFactory, Notifiable, HasApiTokens;

    protected $fillable = [
        'fio',
        'phone',
        'address',
        'commit',
        'type',
        'status',
        'tkun',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function vacancies(){
        return $this->hasMany(Vacancy::class, 'user_id');
    }

    public function managedVacancies(){
        return $this->hasMany(Vacancy::class, 'menejer_id');
    }


}
