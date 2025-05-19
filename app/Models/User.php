<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'username',
        'email',
        'password',
        'role',
        'full_name',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function materials()
    {
        return $this->hasMany(Material::class, 'created_by');
    }

    public function videos()
    {
        return $this->hasMany(Video::class, 'created_by');
    }

    public function quizzes()
    {
        return $this->hasMany(Quiz::class, 'created_by');
    }

    public function quizAttempts()
    {
        return $this->hasMany(QuizAttempt::class);
    }

    public function isMentor()
    {
        return $this->role === 'mentor';
    }

    public function isPeserta()
    {
        return $this->role === 'peserta';
    }
}