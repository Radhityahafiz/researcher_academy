<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = User::where('role', 'peserta')
            ->orderBy('full_name')
            ->paginate(10);
            
        return view('students.index', compact('students'));
    }
}