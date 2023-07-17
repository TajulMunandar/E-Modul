<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class choiceUser extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function User()
    {
        return $this->belongsTo(User::class, 'userId');
    }

    public function Jawaban()
    {
        return $this->belongsTo(jawaban::class, 'jawabanId');
    }
}
