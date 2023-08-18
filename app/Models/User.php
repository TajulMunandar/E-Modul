<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [
        'id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */

    public function moduls()
    {
        return $this->hasMany(modul::class, 'userId', 'id');
    }

    public function komentars()
    {
        return $this->hasMany(Komentar::class, 'userId', 'id');
    }

    public function scores()
    {
        return $this->hasMany(score::class, 'userId', 'id');
    }

    public function essayusers()
    {
        return $this->hasMany(essayUser::class, 'userId', 'id');
    }

    public function choiceusers()
    {
        return $this->hasMany(choiceUser::class, 'userId', 'id');
    }

    public function materiStatus()
    {
        return $this->hasMany(MateriStatus::class, 'userId', 'id');
    }

    public function prodis()
    {
        return $this->belongsTo(Prodi::class, 'prodiId');
    }

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
