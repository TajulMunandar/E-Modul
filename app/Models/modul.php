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

    public function user()
    {
        return $this->belongsTo(User::class, 'userId');
    }

    public function categories()
    {
        return $this->belongsTo(Category::class, 'categoryId');
    }

    public function materi()
    {
        return $this->hasMany(materi::class, 'modulId', 'id');
    }

    public function quizz()
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
