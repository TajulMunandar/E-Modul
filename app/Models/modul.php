<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;


class modul extends Model
{
    use HasFactory;

    use Sluggable;

    protected $guarded = [
        'id'
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'userId', 'id');
    }

    public function prodis()
    {
        return $this->belongsTo(Prodi::class, 'prodiId');
    }

    public function materis()
    {
        return $this->hasMany(materi::class, 'modulId', 'id');
    }

    public function quizzes()
    {
        return $this->hasMany(quiz::class, 'modulId', 'id');
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

}
