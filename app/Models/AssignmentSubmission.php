<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignmentSubmission extends Model
{
    use HasFactory;

    protected $fillable = [
        'assignment_id',
        'user_id',
        'submission_text',
        'file_path',
        'external_link',
        'file_type',
        'score',
        'feedback',
        'submitted_at'
    ];

    protected $casts = [
        'submitted_at' => 'datetime',
    ];

    public function assignment()
    {
        return $this->belongsTo(Assignment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getFileUrlAttribute()
    {
        if ($this->file_path) {
            return asset('storage/' . $this->file_path);
        }
        return null;
    }

    public function getStatusAttribute()
    {
        if ($this->score !== null) {
            return 'Dinilai';
        } elseif ($this->submitted_at) {
            return 'Terkumpul';
        } else {
            return 'Belum dikumpulkan';
        }
    }

    public function passed()
    {
        if ($this->score === null) return false;
        return $this->score >= $this->assignment->max_score * 0.6; // Lulus jika nilai >= 60%
    }
}