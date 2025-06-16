<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\Video;
use App\Models\Option;
use App\Models\Question;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class ParticipantController extends Controller
{
    public function showMaterial(Material $material)
    {
        // Tandai sebagai selesai
        auth()->user()->markAsCompleted($material);

        if ($material->content_type === 'link') {
            return redirect()->away($material->external_link);
        }

        if ($material->content_type === 'file' && 
            pathinfo($material->file_path, PATHINFO_EXTENSION) === 'pdf') {
            return redirect(Storage::url($material->file_path));
        }

        return view('participants.material', compact('material'));
    }

    public function showVideo(Video $video)
    {
        // Tandai sebagai selesai
        auth()->user()->markAsCompleted($video);

        $videoId = $this->extractVideoId($video->video_link);
        return view('participants.video', compact('video', 'videoId'));
    }

    private function extractVideoId($url)
    {
        if (preg_match('/youtube\.com\/watch\?v=([^\&\?\/]+)/', $url, $matches)) {
            return $matches[1];
        }
        if (preg_match('/youtu\.be\/([^\&\?\/]+)/', $url, $matches)) {
            return $matches[1];
        }
        
        if (preg_match('/vimeo\.com\/([0-9]+)/', $url, $matches)) {
            return $matches[1];
        }
        
        return null;
    }
    public function categoryMaterials(Category $category)
    {
        $materials = $category->materials()->latest()->paginate(12);
        return view('participants.category_materials', compact('category', 'materials'));
    }
}