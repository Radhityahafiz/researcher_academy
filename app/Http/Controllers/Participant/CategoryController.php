<?php

namespace App\Http\Controllers\Participant;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show(Category $category)
    {
        $category->load([
            'materials' => function($query) {
                $query->orderBy('created_at', 'asc'); // Materi terlama pertama
            },
            'videos' => function($query) {
                $query->orderBy('created_at', 'asc'); // Video terlama pertama
            },
            'assignments' => function($query) {
                $query->orderBy('created_at', 'asc');
            }
        ]);
        
        return view('participants.categories_show', compact('category'));
    }
}