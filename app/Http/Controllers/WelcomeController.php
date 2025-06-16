<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Material;
use App\Models\Video;
use App\Models\Testimonial;
use App\Models\Assignment;
use Illuminate\Support\Facades\Auth;

class WelcomeController extends Controller
{
    public function index()
{
    $categories = Category::withCount(['materials', 'videos', 'assignments'])
        ->orderBy('created_at', 'asc')
        ->paginate(15, ['*'], 'categories_page');
        
    $videos = Video::latest()->paginate(15, ['*'], 'videos_page');
    
    $testimonials = Testimonial::approved()
        ->with('user')
        ->orderBy('created_at', 'asc')
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

        $totalAssignments = Assignment::count();
        $completedAssignments = $user->assignmentSubmissions()->count();
        $assignmentProgress = $totalAssignments > 0 ? round(($completedAssignments / $totalAssignments) * 100) : 0;

        return view('welcome', [
            'categories' => $categories,
            'videos' => $videos,
            'testimonials' => $testimonials,
            'materialProgress' => $materialProgress,
            'completedMaterials' => $completedMaterials,
            'totalMaterials' => $totalMaterials,
            'videoProgress' => $videoProgress,
            'completedVideos' => $completedVideos,
            'totalVideos' => $totalVideos,
            'assignmentProgress' => $assignmentProgress,
            'completedAssignments' => $completedAssignments,
            'totalAssignments' => $totalAssignments
        ]);
    }

    return view('welcome', [
        'categories' => $categories,
        'videos' => $videos,
        'testimonials' => $testimonials
    ]);
}
}