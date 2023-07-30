<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class quiz extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public function moduls()
    {
        return $this->belongsTo(modul::class, 'modulId');
    }

    public function questions()
    {
        return $this->hasMany(quiz::class, 'quizId', 'id');
    }

    public function scores()
    {
        return $this->hasMany(score::class);
    }
}
