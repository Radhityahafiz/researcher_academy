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
        'status'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Relasi
    public function materials() { return $this->hasMany(Material::class, 'created_by'); }
    public function videos() { return $this->hasMany(Video::class, 'created_by'); }
    public function assignments() { return $this->hasMany(Assignment::class); }
    public function assignmentSubmissions() { return $this->hasMany(AssignmentSubmission::class); }
    public function userProgress() { return $this->hasMany(UserProgress::class); }

    // Role check
    public function isMentor() { return $this->role === 'mentor'; }
    public function isPeserta() { return $this->role === 'peserta'; }

    //method untuk status
    public function isActive()
    {
        return $this->status === 'active';
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeInactive($query)
    {
        return $query->where('status', 'inactive');
    }

    // Stat
    public static function countPeserta() {
        return self::where('role', 'peserta')->count();
    }

    // Completed progress
    public function completedMaterials() {
        return $this->morphedByMany(Material::class, 'progressable', 'user_progress')->withTimestamps()->whereNotNull('completed_at');
    }

    public function completedVideos() {
        return $this->morphedByMany(Video::class, 'progressable', 'user_progress')->withTimestamps()->whereNotNull('completed_at');
    }

    public function completedAssignments() {
        return $this->morphedByMany(Assignment::class, 'progressable', 'user_progress')->withTimestamps()->whereNotNull('completed_at');
    }

    public function markAsCompleted($model) {
        return $this->morphedByMany(get_class($model), 'progressable', 'user_progress')
            ->syncWithoutDetaching([
                $model->id => ['completed_at' => now()]
            ]);
    }
}
