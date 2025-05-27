<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\Video;
use App\Models\Quiz;
use App\Models\Category;

class WelcomeController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('materials')->latest()->paginate(15, ['*'], 'categories_page');
        $videos = Video::latest()->paginate(15, ['*'], 'videos_page');
        $quizzes = Quiz::withCount('questions')->latest()->paginate(15, ['*'], 'quizzes_page');

        return view('welcome', compact('categories', 'videos', 'quizzes'));
    }
}

