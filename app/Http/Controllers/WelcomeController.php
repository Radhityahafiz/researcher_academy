<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Material;
use App\Models\Video;
use App\Models\Quiz;
use App\Models\Testimonial;
use Illuminate\Support\Facades\Auth;

class WelcomeController extends Controller
{
    public function index()
{
    $categories = Category::withCount(['materials', 'videos', 'quizzes'])
        ->orderBy('created_at', 'asc')
        ->paginate(15, ['*'], 'categories_page');
        
    $videos = Video::latest()->paginate(15, ['*'], 'videos_page');
    $quizzes = Quiz::withCount('questions')->latest()->paginate(15, ['*'], 'quizzes_page');
    
    // Tambahkan ini untuk mengambil testimoni yang sudah disetujui
    $testimonials = Testimonial::approved()
        ->with('user')
        ->latest()
        ->take(5)
        ->get();

    if (Auth::check()) {
        $user = Auth::user();
        
        $totalMaterials = Material::count();
        $completedMaterials = $user->completedMaterials()->count();
        $materialProgress = $totalMaterials > 0 ? round(($completedMaterials / $totalMaterials) * 100) : 0;

        $totalVideos = Video::count();
        $completedVideos = $user->completedVideos()->count();
        $videoProgress = $totalVideos > 0 ? round(($completedVideos / $totalVideos) * 100) : 0;

        $totalQuizzes = Quiz::count();
        $completedQuizzes = $user->quizAttempts()->count();
        $quizProgress = $totalQuizzes > 0 ? round(($completedQuizzes / $totalQuizzes) * 100) : 0;

        return view('welcome', [
            'categories' => $categories,
            'videos' => $videos,
            'quizzes' => $quizzes,
            'testimonials' => $testimonials,
            'materialProgress' => $materialProgress,
            'completedMaterials' => $completedMaterials,
            'totalMaterials' => $totalMaterials,
            'videoProgress' => $videoProgress,
            'completedVideos' => $completedVideos,
            'totalVideos' => $totalVideos,
            'quizProgress' => $quizProgress,
            'completedQuizzes' => $completedQuizzes,
            'totalQuizzes' => $totalQuizzes
        ]);
    }

    return view('welcome', [
        'categories' => $categories,
        'videos' => $videos,
        'quizzes' => $quizzes,
        'testimonials' => $testimonials
    ]);
}
}