<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $fillable = ['category_id', 'title', 'description', 'video_link', 'created_by'];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getVideoIdAttribute()
    {
        if (str_contains($this->video_link, 'youtube.com')) {
            parse_str(parse_url($this->video_link, PHP_URL_QUERY), $params);
            return $params['v'] ?? null;
        } elseif (str_contains($this->video_link, 'youtu.be')) {
            return substr(parse_url($this->video_link, PHP_URL_PATH), 1);
        } elseif (str_contains($this->video_link, 'vimeo.com')) {
            return substr(parse_url($this->video_link, PHP_URL_PATH), 1);
        }
        return null;
    }
}