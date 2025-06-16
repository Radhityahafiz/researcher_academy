<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Material;
use App\Models\Video;
use App\Models\Assignment;
use App\Models\AssignmentSubmission;
use Illuminate\Http\Request;

class ProgressController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        // Hitung progress materi
        $totalMaterials = Material::count();
        $completedMaterials = $user->completedMaterials()->count();
        $materialProgress = $totalMaterials > 0 ? round(($completedMaterials / $totalMaterials) * 100) : 0;

        // Hitung progress video
        $totalVideos = Video::count();
        $completedVideos = $user->completedVideos()->count();
        $videoProgress = $totalVideos > 0 ? round(($completedVideos / $totalVideos) * 100) : 0;

        // Hitung progress tugas
        $totalAssignments = Assignment::count();
        $completedAssignments = $user->assignmentSubmissions()->count();
        $assignmentProgress = $totalAssignments > 0 ? round(($completedAssignments / $totalAssignments) * 100) : 0;

        return view('progress.index', compact(
            'materialProgress', 'completedMaterials', 'totalMaterials',
            'videoProgress', 'completedVideos', 'totalVideos',
            'assignmentProgress', 'completedAssignments', 'totalAssignments'
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

    public function showAssignments()
    {
        $user = auth()->user();
        $submissions = $user->assignmentSubmissions()->with('assignment.category')->get();
        $allAssignments = Assignment::with('category')->get();

        return view('participants.progress.assignments', compact('submissions', 'allAssignments'));
    }
}