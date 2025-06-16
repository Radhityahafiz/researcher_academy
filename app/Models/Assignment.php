<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'user_id',
        'title',
        'description',
        'file_path',
        'external_link',
        'file_type',
        'due_date',
        'max_score'
    ];

    protected $dates = ['due_date'];
    
    protected $casts = [
        'due_date' => 'datetime', // Ini akan mengkonversi string ke Carbon instance
        // ... casts lainnya jika ada
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function submissions()
    {
        return $this->hasMany(AssignmentSubmission::class);
    }

    public function getFileUrlAttribute()
    {
        if ($this->file_path) {
            return asset('storage/' . $this->file_path);
        }
        return null;
    }

    public function isPastDue()
    {
        return now()->greaterThan($this->due_date);
    }
}