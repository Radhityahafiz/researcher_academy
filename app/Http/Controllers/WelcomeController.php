<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\Video;
use App\Models\Quiz;

class WelcomeController extends Controller
{
    public function index()
    {
        $materials = Material::latest()->paginate(15, ['*'], 'materials_page'); // 15 item per halaman
        $videos = Video::latest()->paginate(15, ['*'], 'videos_page');
        $quizzes = Quiz::withCount('questions')->latest()->paginate(15, ['*'], 'quizzes_page');

        return view('welcome', compact('materials', 'videos', 'quizzes'));
    }
}