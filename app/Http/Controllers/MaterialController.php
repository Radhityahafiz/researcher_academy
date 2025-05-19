<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MaterialController extends Controller
{
    public function index()
    {
        $materials = Material::with('category', 'creator')->latest()->get();
        return view('materials.index', compact('materials'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('materials.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:100',
            'description' => 'nullable|string',
            'content_type' => 'required|in:file,link,text',
            'file' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx,txt|required_if:content_type,file',
            'external_link' => 'nullable|url|required_if:content_type,link',
            'content' => 'nullable|string|required_if:content_type,text',
        ]);

        try {
            $data = [
                'category_id' => $request->category_id,
                'title' => $request->title,
                'description' => $request->description,
                'content_type' => $request->content_type,
                'created_by' => auth()->id(),
            ];

            if ($request->content_type === 'file') {
                if ($request->hasFile('file')) {
                    $data['file_path'] = $request->file('file')->store('materials', 'public');
                }
                $data['external_link'] = null;
                $data['content'] = null;
            } elseif ($request->content_type === 'link') {
                $data['external_link'] = $request->external_link;
                $data['file_path'] = null;
                $data['content'] = null;
            } else {
                $data['content'] = $request->content;
                $data['file_path'] = null;
                $data['external_link'] = null;
            }

            Material::create($data);

            return redirect()->route('materials.index')->with('success', 'Material created successfully.');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Error creating material: ' . $e->getMessage());
        }
    }

    public function show(Material $material)
    {
        return view('materials.show', compact('material'));
    }

    public function edit(Material $material)
    {
        $categories = Category::all();
        return view('materials.edit', compact('material', 'categories'));
    }

    public function update(Request $request, Material $material)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:100',
            'description' => 'nullable|string',
            'content_type' => 'required|in:file,link,text',
            'file' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx,txt|required_if:content_type,file',
            'external_link' => 'nullable|url|required_if:content_type,link',
            'content' => 'nullable|string|required_if:content_type,text',
        ]);

        try {
            $data = [
                'category_id' => $request->category_id,
                'title' => $request->title,
                'description' => $request->description,
                'content_type' => $request->content_type,
            ];

            if ($request->content_type === 'file') {
                if ($request->hasFile('file')) {
                    // Delete old file if exists
                    if ($material->file_path) {
                        Storage::delete($material->file_path);
                    }
                    $data['file_path'] = $request->file('file')->store('materials', 'public');
                } else {
                    // Keep existing file if no new file uploaded
                    $data['file_path'] = $material->file_path;
                }
                $data['external_link'] = null;
                $data['content'] = null;
            } elseif ($request->content_type === 'link') {
                $data['external_link'] = $request->external_link;
                $data['file_path'] = null;
                $data['content'] = null;
            } else {
                $data['content'] = $request->content;
                $data['file_path'] = null;
                $data['external_link'] = null;
            }

            $material->update($data);

            return redirect()->route('materials.index')->with('success', 'Material updated successfully.');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Error updating material: ' . $e->getMessage());
        }
    }

    public function destroy(Material $material)
    {
        try {
            if ($material->file_path) {
                Storage::disk('public')->delete($material->file_path);
            }
            $material->delete();
            return redirect()->route('materials.index')->with('success', 'Material deleted successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Error deleting material: ' . $e->getMessage());
        }
    }
}