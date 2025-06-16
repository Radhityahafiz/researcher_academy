<?php

namespace App\Http\Controllers\Participant;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\AssignmentSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AssignmentController extends Controller
{
    public function index()
    {
        $assignments = Assignment::with(['category', 'submissions' => function($query) {
                $query->where('user_id', auth()->id());
            }])
            ->latest()
            ->paginate(10);

        return view('participants.assignments.index', compact('assignments'));
    }

    public function show(Assignment $assignment)
    {
        $submission = $assignment->submissions()
            ->where('user_id', auth()->id())
            ->first();

        return view('participants.assignments.show', compact('assignment', 'submission'));
    }

    public function submit(Request $request, Assignment $assignment)
    {
        if ($assignment->isPastDue()) {
            return back()->with('error', 'Batas waktu pengumpulan sudah lewat');
        }

        $request->validate([
            'submission_text' => 'nullable|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'external_link' => 'nullable|url',
        ], [
            'file.mimes' => 'File harus berupa PDF, DOC, atau DOCX',
            'file.max' => 'Ukuran file maksimal 2MB',
        ]);

        $submission = AssignmentSubmission::firstOrNew([
            'assignment_id' => $assignment->id,
            'user_id' => auth()->id(),
        ]);

        $submission->submission_text = $request->submission_text;

        if ($request->hasFile('file')) {
            // Hapus file lama jika ada
            if ($submission->file_path) {
                Storage::disk('public')->delete($submission->file_path);
            }

            $file = $request->file('file');
            $path = $file->store('assignment-submissions', 'public');
            $submission->file_path = $path;
            $submission->file_type = $file->getClientOriginalExtension();
            $submission->external_link = null;
        } elseif ($request->external_link) {
            // Hapus file lama jika ada
            if ($submission->file_path) {
                Storage::disk('public')->delete($submission->file_path);
                $submission->file_path = null;
            }

            $submission->external_link = $request->external_link;
            $submission->file_type = 'link';
        }

        $submission->submitted_at = now();
        $submission->save();

        return redirect()->route('participant.assignments.show', $assignment)
            ->with('success', 'Tugas berhasil dikumpulkan');
    }
}