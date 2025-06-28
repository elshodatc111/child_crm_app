<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VacancyChildComment extends Model
{
    use HasFactory;

    protected $fillable = [
        'vacancy_child_id',
        'description',
        'meneger',
    ];

    public function vacancyChild()
    {
        return $this->belongsTo(VacancyChild::class);
    }
}
