<?php

namespace App\Http\Controllers\Peserta;

use App\Http\Controllers\Controller;
use App\Models\Material;
use App\Models\Quiz;
use App\Models\Video;

class DashboardController extends Controller
{
    public function index()
    {
        $materials = Material::latest()->take(3)->get();
        $videos = Video::latest()->take(3)->get();
        $quizzes = Quiz::latest()->take(3)->get();
        
        return view('peserta.dashboard', compact('materials', 'videos', 'quizzes'));
    }
}