<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Models\Category;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function index()
    {
        $videos = Video::with('creator')->latest()->get();
        return view('videos.index', compact('videos'));
    }

   public function create()
    {
        $categories = Category::all();
        return view('videos.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:100',
            'description' => 'nullable|string',
            'video_link' => 'required|url',
        ]);

        Video::create([
            'category_id' => $request->category_id,
            'title' => $request->title,
            'description' => $request->description,
            'video_link' => $request->video_link,
            'created_by' => auth()->id(),
        ]);

        return redirect()->route('videos.index')->with('success', 'Video created successfully.');
    }

    public function show(Video $video)
    {
        return view('videos.show', compact('video'));
    }

    public function edit(Video $video)
    {
        $categories = Category::all();
        return view('videos.edit', compact('video', 'categories'));
    }

    public function update(Request $request, Video $video)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:100',
            'description' => 'nullable|string',
            'video_link' => 'required|url',
        ]);

        $video->update([
            'category_id' => $request->category_id,
            'title' => $request->title,
            'description' => $request->description,
            'video_link' => $request->video_link,
        ]);

        return redirect()->route('videos.index')->with('success', 'Video updated successfully.');
    }

    public function destroy(Video $video)
    {
        $video->delete();
        return redirect()->route('videos.index')->with('success', 'Video deleted successfully.');
    }
}