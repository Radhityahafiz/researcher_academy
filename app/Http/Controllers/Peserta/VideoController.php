<?php

namespace App\Http\Controllers\Peserta;

use App\Http\Controllers\Controller;
use App\Models\Video;

class VideoController extends Controller
{
    public function index()
    {
        $videos = Video::with('creator')->latest()->get();
        return view('peserta.videos.index', compact('videos'));
    }

    public function show(Video $video)
    {
        return view('peserta.videos.show', compact('video'));
    }
}