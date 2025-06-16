<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Category;
use App\Models\AssignmentSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests; 

class AssignmentController extends Controller
{
     use AuthorizesRequests;
    public function index()
    {
        $assignments = Assignment::with(['category', 'user'])
            ->where('user_id', auth()->id())
            ->orderBy('created_at', 'asc') 
            ->paginate(10);

        return view('assignments.index', compact('assignments'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('assignments.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'external_link' => 'nullable|url',
            'due_date' => 'required|date|after:now',
            'max_score' => 'required|integer|min:1|max:1000',
        ]);

        $assignment = new Assignment();
        $assignment->user_id = auth()->id();
        $assignment->category_id = $request->category_id;
        $assignment->title = $request->title;
        $assignment->description = $request->description;
        $assignment->due_date = $request->due_date;
        $assignment->max_score = $request->max_score;

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $path = $file->store('assignments', 'public');
            $assignment->file_path = $path;
            $assignment->file_type = $file->getClientOriginalExtension();
        } elseif ($request->external_link) {
            $assignment->external_link = $request->external_link;
            $assignment->file_type = 'link';
        }

        $assignment->save();

        return redirect()->route('assignments.index')
            ->with('success', 'Penugasan berhasil dibuat');
    }

    public function show(Assignment $assignment)
    {
        $this->authorize('view', $assignment);
        
        $submissions = $assignment->submissions()
            ->with('user')
            ->latest()
            ->paginate(10);

        return view('assignments.show', compact('assignment', 'submissions'));
    }

    public function showSubmission(AssignmentSubmission $submission)
{
    $this->authorize('grade', $submission);
    
    return view('assignments.submission', compact('submission'));
}

    public function edit(Assignment $assignment)
    {
        $this->authorize('update', $assignment);
        
        $categories = Category::all();
        return view('assignments.edit', compact('assignment', 'categories'));
    }

    public function update(Request $request, Assignment $assignment)
    {
        $this->authorize('update', $assignment);

        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'external_link' => 'nullable|url',
            'due_date' => 'required|date|after:now',
            'max_score' => 'required|integer|min:1|max:1000',
        ]);

        $assignment->category_id = $request->category_id;
        $assignment->title = $request->title;
        $assignment->description = $request->description;
        $assignment->due_date = $request->due_date;
        $assignment->max_score = $request->max_score;

        if ($request->hasFile('file')) {
            // Hapus file lama jika ada
            if ($assignment->file_path) {
                Storage::disk('public')->delete($assignment->file_path);
            }

            $file = $request->file('file');
            $path = $file->store('assignments', 'public');
            $assignment->file_path = $path;
            $assignment->file_type = $file->getClientOriginalExtension();
            $assignment->external_link = null;
        } elseif ($request->external_link) {
            // Hapus file lama jika ada
            if ($assignment->file_path) {
                Storage::disk('public')->delete($assignment->file_path);
                $assignment->file_path = null;
            }

            $assignment->external_link = $request->external_link;
            $assignment->file_type = 'link';
        }

        $assignment->save();

        return redirect()->route('assignments.index')
            ->with('success', 'Penugasan berhasil diperbarui');
    }

    public function destroy(Assignment $assignment)
    {
        $this->authorize('delete', $assignment);

        // Hapus file jika ada
        if ($assignment->file_path) {
            Storage::disk('public')->delete($assignment->file_path);
        }

        $assignment->delete();

        return redirect()->route('assignments.index')
            ->with('success', 'Penugasan berhasil dihapus');
    }

    public function gradeSubmission(Request $request, AssignmentSubmission $submission)
    {
        $this->authorize('grade', $submission);

        $request->validate([
            'score' => 'required|integer|min:0|max:' . $submission->assignment->max_score,
            'feedback' => 'nullable|string',
        ]);

        $submission->score = $request->score;
        $submission->feedback = $request->feedback;
        $submission->save();

        return back()->with('success', 'Nilai berhasil disimpan');
    }

    public function export(Assignment $assignment)
{
    $this->authorize('view', $assignment);
    
    $submissions = $assignment->submissions()
        ->with('user')
        ->get();
    
    $headers = [
        'Content-Type' => 'text/csv',
        'Content-Disposition' => 'attachment; filename="nilai-' . $assignment->title . '.csv"',
    ];

    $callback = function() use ($submissions, $assignment) {
        $file = fopen('php://output', 'w');
        
        // Header CSV
        fputcsv($file, [
            'Nama Peserta', 
            'Email', 
            'Tanggal Kumpul', 
            'Nilai', 
            'Status',
            'Feedback'
        ]);
        
        // Data CSV
        foreach ($submissions as $submission) {
            fputcsv($file, [
                $submission->user->full_name,
                $submission->user->email,
                $submission->submitted_at ? $submission->submitted_at->format('d M Y H:i') : '-',
                $submission->score !== null ? $submission->score . '/' . $assignment->max_score : '-',
                $submission->status,
                $submission->feedback ?? '-'
            ]);
        }
        
        fclose($file);
    };
    
    return response()->stream($callback, 200, $headers);
}
}