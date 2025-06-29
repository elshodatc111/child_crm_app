<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VacancyComment extends Model{
    use HasFactory;
    protected $fillable = [
        'vacancy_id',
        'description',
        'meneger_id',
    ];
    public function vacancy()
    {
        return $this->belongsTo(Vacancy::class);
    }
}
