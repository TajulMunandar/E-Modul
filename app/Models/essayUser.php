<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class essayUser extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'userId');
    }

    public function questions()
    {
        return $this->belongsTo(question::class, 'questionId');
    }

}
