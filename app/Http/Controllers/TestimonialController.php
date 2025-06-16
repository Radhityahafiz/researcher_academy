<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::approved()
            ->with('user')
            ->orderBy('created_at', 'asc')
            ->paginate(10);

        return view('participants.testimonials.index', compact('testimonials'));
    }

    public function create()
    {
        // Cek apakah user sudah pernah memberikan testimoni
        $existingTestimonial = Testimonial::where('user_id', Auth::id())->first();
        
        if ($existingTestimonial) {
            return redirect()->route('testimonials.index')
                ->with('info', 'Anda sudah memberikan testimoni sebelumnya.');
        }

        return view('participants.testimonials.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string|min:20|max:500',
            'rating' => 'required|integer|between:1,5',
        ]);

        Testimonial::create([
            'user_id' => Auth::id(),
            'content' => $request->content,
            'rating' => $request->rating,
            'status' => 'pending', // Admin perlu approve dulu
        ]);

        return redirect()->route('testimonials.index')
            ->with('success', 'Testimoni Anda berhasil dikirim. Menunggu persetujuan admin.');
    }

    public function edit(Testimonial $testimonial)
    {
        // Pastikan hanya pemilik testimoni yang bisa edit
        if ($testimonial->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('participants.testimonials.edit', compact('testimonial'));
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        // Pastikan hanya pemilik testimoni yang bisa update
        if ($testimonial->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'content' => 'required|string|min:20|max:500',
            'rating' => 'required|integer|between:1,5',
        ]);

        $testimonial->update([
            'content' => $request->content,
            'rating' => $request->rating,
            'status' => 'pending', // Set status kembali ke pending setelah edit
        ]);

        return redirect()->route('testimonials.index')
            ->with('success', 'Testimoni Anda berhasil diperbarui. Menunggu persetujuan admin.');
    }

    public function dashboard()
    {
        $testimonials = Testimonial::with('user')
            ->latest()
            ->paginate(10);

        return view('testi_dashboard', compact('testimonials'));
    }

    public function show(Testimonial $testimonial)
    {
        return view('testi_show', compact('testimonial'));
    }

    public function approve(Testimonial $testimonial)
    {
        $testimonial->update(['status' => 'approved']);
        return back()->with('success', 'Testimoni telah disetujui');
    }

    public function reject(Testimonial $testimonial)
    {
        $testimonial->update(['status' => 'rejected']);
        return back()->with('success', 'Testimoni telah ditolak');
    }

    public function destroy(Testimonial $testimonial)
    {
        $testimonial->delete();
        return back()->with('success', 'Testimoni telah dihapus');
    }
}