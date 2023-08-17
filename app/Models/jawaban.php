<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jawaban extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public function questions()
    {
        return $this->belongsTo(question::class, 'questionId');
    }

    public function choiceUser()
    {
        return $this->hasMany(choiceUser::class, 'jawabanId', 'id');
    }
}
