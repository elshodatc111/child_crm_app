<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Darslar extends Model
{
    use HasFactory;

    protected $table = 'darslars';

    protected $fillable = [
        'group_id',
        'teacher_id',
        'lesson_name',
        'child_count',
        'user_id',
    ];

    // Aloqalar
    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
