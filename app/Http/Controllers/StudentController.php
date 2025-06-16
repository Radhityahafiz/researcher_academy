<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Carbon\Carbon;

class StudentController extends Controller
{
    public function index()
    {
        $students = User::where('role', 'peserta')
            ->orderBy('full_name')
            ->paginate(10);
            
        return view('students.index', compact('students'));
    }

    public function create()
    {
        return view('students.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'status' => 'required|in:active,inactive'
        ]);

        $validated['password'] = bcrypt($validated['password']);
        $validated['role'] = 'peserta';

        User::create($validated);

        return redirect()->route('students.index')
            ->with('success', 'Peserta berhasil ditambahkan');
    }

    public function edit(User $student)
    {
        // Pastikan yang diedit adalah peserta
        if ($student->role !== 'peserta') {
            abort(403, 'Hanya peserta yang bisa diedit');
        }

        return view('students.edit', compact('student'));
    }

    public function update(Request $request, User $student)
    {
        // Pastikan yang diedit adalah peserta
        if ($student->role !== 'peserta') {
            abort(403, 'Hanya peserta yang bisa diupdate');
        }

        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,'.$student->id,
            'email' => 'required|email|unique:users,email,'.$student->id,
            'password' => 'nullable|string|min:8|confirmed',
            'status' => 'required|in:active,inactive'
        ]);

        if ($request->filled('password')) {
            $validated['password'] = bcrypt($validated['password']);
        } else {
            unset($validated['password']);
        }

        $student->update($validated);

        return redirect()->route('students.index')
            ->with('success', 'Data peserta berhasil diperbarui');
    }

    public function destroy(User $student)
    {
        // Pastikan yang dihapus adalah peserta
        if ($student->role !== 'peserta') {
            abort(403, 'Hanya peserta yang bisa dihapus');
        }

        $student->delete();

        return redirect()->route('students.index')
            ->with('success', 'Peserta berhasil dihapus');
    }

    public function toggleStatus(User $student)
    {
        // Pastikan yang diubah statusnya adalah peserta
        if ($student->role !== 'peserta') {
            abort(403, 'Hanya peserta yang bisa diubah statusnya');
        }

        $student->update([
            'status' => $student->status === 'active' ? 'inactive' : 'active'
        ]);

        return back()->with('success', 'Status peserta berhasil diubah');
    }

    public function exportCSV()
    {
        // Only allow mentors to export
        if (!auth()->user()->isMentor()) {
            abort(403, 'Unauthorized action.');
        }

        $students = User::where('role', 'peserta')
            ->orderBy('full_name')
            ->get();

        $fileName = 'students_' . Carbon::now()->format('Ymd_His') . '.csv';

        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ];

        $columns = ['No', 'Full Name', 'Username', 'Email', 'Status', 'Registered At'];

        $callback = function() use ($students, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($students as $index => $student) {
                $row = [
                    $index + 1,
                    $student->full_name,
                    $student->username,
                    $student->email,
                    $student->status,
                    $student->created_at->format('d M Y')
                ];

                fputcsv($file, $row);
            }

            fclose($file);
        };

        return Response::stream($callback, 200, $headers);
    }
}