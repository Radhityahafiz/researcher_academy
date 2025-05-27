<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\Video;
use App\Models\Quiz;
use App\Models\QuizAttempt;
use App\Models\Option;
use App\Models\Question;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class ParticipantController extends Controller
{
    public function quizIndex()
    {
        $quizzes = Quiz::withCount('questions')->latest()->get();
        return view('participants.quizzes.index', compact('quizzes'));
    }

    public function showQuiz(Quiz $quiz)
    {
        $quiz->load('questions.options');
        $attempt = $quiz->attempts()->where('user_id', auth()->id())->first();
        
        return view('participants.quizzes.show', [
            'quiz' => $quiz,
            'attempt' => $attempt
        ]);
    }

    public function startQuiz(Quiz $quiz, Request $request)
{
    // Cek jika user sudah menyelesaikan quiz ini
    $existingAttempt = $quiz->attempts()
        ->where('user_id', auth()->id())
        ->whereNotNull('completed_at')
        ->first();
        
    if ($existingAttempt) {
        return redirect()->route('participant.quizzes.result', $existingAttempt)
               ->with('info', 'Anda sudah menyelesaikan quiz ini.');
    }

    // Ambil nomor pertanyaan saat ini dari query string (?question=2)
    $currentQuestion = (int) $request->query('question', 1);
    $totalQuestions = $quiz->questions()->count();

    // Validasi nomor pertanyaan
    if ($currentQuestion < 1 || $currentQuestion > $totalQuestions) {
        $currentQuestion = 1;
    }

    // Ambil pertanyaan saat ini beserta opsi jawaban
    $question = $quiz->questions()
        ->with('options')
        ->orderBy('id')
        ->skip($currentQuestion - 1)
        ->first();

    if (!$question) {
        return redirect()->route('participant.quizzes.show', $quiz)
               ->with('error', 'Tidak ada pertanyaan ditemukan untuk quiz ini.');
    }

    // Ambil jawaban sementara dari session
    $quizProgress = session()->get('quiz_progress', []);
    $savedAnswers = $quizProgress[$quiz->id] ?? [];

    // Kirim ke view
    return view('participants.quizzes.attempt', [
        'quiz' => $quiz,
        'question' => $question,
        'currentQuestion' => $currentQuestion,
        'totalQuestions' => $totalQuestions,
        'savedAnswers' => $savedAnswers
    ]);
}


    public function saveProgress(Request $request, Quiz $quiz)
{
    $request->validate([
        'answers' => 'required|array',
        'answers.*' => 'required|exists:options,id',
    ]);

    // Simpan jawaban sementara di session
    $quizProgress = session()->get('quiz_progress', []);
    $quizProgress[$quiz->id] = $request->answers;
    session()->put('quiz_progress', $quizProgress);

    return response()->json(['status' => 'success']);
}

    public function submitQuiz(Request $request, Quiz $quiz)
{
    // Cek jika user sudah menyelesaikan quiz ini
    if ($quiz->attempts()->where('user_id', auth()->id())->whereNotNull('completed_at')->exists()) {
        return redirect()->route('participant.quizzes.index')
               ->with('error', 'Anda sudah menyelesaikan quiz ini.');
    }

    // Validasi jawaban
    $request->validate([
        'answers' => 'required|array',
        'answers.*' => 'required|exists:options,id',
    ]);

    // Buat attempt baru
    $attempt = $quiz->attempts()->create([
        'user_id' => auth()->id(),
    ]);

    $totalQuestions = $quiz->questions()->count();
    $correctAnswers = 0;

    // Proses jawaban
    foreach ($quiz->questions as $question) {
        $selectedOptionId = $request->answers[$question->id] ?? null;

        if ($selectedOptionId) {
            $selectedOption = Option::find($selectedOptionId);
            $isCorrect = $selectedOption->is_correct;

            if ($isCorrect) {
                $correctAnswers++;
            }

            $attempt->answers()->create([
                'question_id' => $question->id,
                'option_id' => $selectedOptionId,
                'is_correct' => $isCorrect,
            ]);
        }
    }

    // Hitung score
    $score = ($correctAnswers / $totalQuestions) * 100;
    $attempt->update([
        'score' => $score,
        'completed_at' => now(),
    ]);

    // Hapus data progress dari session
    $quizProgress = session()->get('quiz_progress', []);
    unset($quizProgress[$quiz->id]);
    session()->put('quiz_progress', $quizProgress);

    // Redirect ke hasil dengan pesan sukses
    return redirect()->route('participant.quizzes.result', $attempt)
           ->with('success', 'Quiz berhasil disubmit!');
}

    public function quizResult(QuizAttempt $attempt)
    {
        $attempt->load('quiz.questions.options', 'answers.option');
        return view('participants.quizzes.result', compact('attempt'));
    }

    public function showMaterial(Material $material)
    {
        if ($material->content_type === 'link') {
            return redirect()->away($material->external_link);
        }

        if ($material->content_type === 'file' && 
            pathinfo($material->file_path, PATHINFO_EXTENSION) === 'pdf') {
            return redirect(Storage::url($material->file_path));
        }

        return view('participants.material', compact('material'));
    }

    public function showVideo(Video $video)
    {
        $videoId = $this->extractVideoId($video->video_link);
        return view('participants.video', compact('video', 'videoId'));
    }

    private function extractVideoId($url)
    {
        if (preg_match('/youtube\.com\/watch\?v=([^\&\?\/]+)/', $url, $matches)) {
            return $matches[1];
        }
        if (preg_match('/youtu\.be\/([^\&\?\/]+)/', $url, $matches)) {
            return $matches[1];
        }
        
        if (preg_match('/vimeo\.com\/([0-9]+)/', $url, $matches)) {
            return $matches[1];
        }
        
        return null;
    }
    public function categoryMaterials(Category $category)
    {
        $materials = $category->materials()->latest()->paginate(12);
        return view('participants.category_materials', compact('category', 'materials'));
    }
}