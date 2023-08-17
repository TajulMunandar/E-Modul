<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class question extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public function jawabans()
    {
        return $this->hasMany(jawaban::class, 'questionId', 'id');
    }

    public function essayusers()
    {
        return $this->hasMany(essayUser::class, 'questionId', 'id');
    }

    public function quizzes()
    {
        return $this->belongsTo(quiz::class, 'quizId', 'id');
    }
}
