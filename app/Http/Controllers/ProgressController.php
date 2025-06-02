<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Material;
use App\Models\Video;
use App\Models\Quiz;
use App\Models\QuizAttempt;
use App\Models\UserProgress;
use Illuminate\Http\Request;

class ProgressController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        // Hitung progress
        $totalMaterials = Material::count();
        $completedMaterials = $user->completedMaterials()->count();
        $materialProgress = $totalMaterials > 0 ? round(($completedMaterials / $totalMaterials) * 100) : 0;

        $totalVideos = Video::count();
        $completedVideos = $user->completedVideos()->count();
        $videoProgress = $totalVideos > 0 ? round(($completedVideos / $totalVideos) * 100) : 0;

        $totalQuizzes = Quiz::count();
        $completedQuizzes = $user->quizAttempts()->count();
        $quizProgress = $totalQuizzes > 0 ? round(($completedQuizzes / $totalQuizzes) * 100) : 0;

        return view('progress.index', compact(
            'materialProgress', 'completedMaterials', 'totalMaterials',
            'videoProgress', 'completedVideos', 'totalVideos',
            'quizProgress', 'completedQuizzes', 'totalQuizzes'
        ));
    }

    public function showMaterials()
    {
        $user = auth()->user();
        $completedMaterials = $user->completedMaterials()->with('category')->get();
        $allMaterials = Material::with('category')->get();

        return view('participants.progress.materials', compact('completedMaterials', 'allMaterials'));
    }

    public function showVideos()
    {
        $user = auth()->user();
        $completedVideos = $user->completedVideos()->with('category')->get();
        $allVideos = Video::with('category')->get();

        return view('participants.progress.videos', compact('completedVideos', 'allVideos'));
    }

    public function showQuizzes()
    {
        $user = auth()->user();
        $quizAttempts = $user->quizAttempts()->with('quiz')->get();
        $allQuizzes = Quiz::all();

        return view('participants.progress.quizzes', compact('quizAttempts', 'allQuizzes'));
    }
}