<?php

namespace App\Http\Controllers\Peserta;

use App\Http\Controllers\Controller;
use App\Models\Material;

class MaterialController extends Controller
{
    public function index()
    {
        $materials = Material::with('category', 'creator')->latest()->get();
        return view('peserta.materials.index', compact('materials'));
    }

    public function show(Material $material)
    {
        return view('peserta.materials.show', compact('material'));
    }
}