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

    public function modul()
    {
        return $this->belongsTo(modul::class, 'modulId');
    }

    public function question()
    {
        return $this->hasMany(quiz::class);
    }
}
