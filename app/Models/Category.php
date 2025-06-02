<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'thumbnail'];

    public function materials()
    {
        return $this->hasMany(Material::class);
    }

    public function videos()
    {
        return $this->hasMany(Video::class);
    }

    public function quizzes()
    {
        return $this->hasMany(Quiz::class);
    }

    public function getThumbnailUrlAttribute()
    {
        if ($this->thumbnail) {
            return asset('storage/' . $this->thumbnail);
        }
        return null;
    }
}