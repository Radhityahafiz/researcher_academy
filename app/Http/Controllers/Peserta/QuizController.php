<?php

namespace App\Http\Controllers\Peserta;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use App\Models\QuizAttempt;
use App\Models\Question;
use App\Models\Option;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function index()
    {
        $quizzes = Quiz::with('creator')->latest()->get();
        return view('peserta.quizzes.index', compact('quizzes'));
    }

    public function show(Quiz $quiz)
    {
        $quiz->load('questions.options');
        $hasAttempted = $quiz->attempts()->where('user_id', auth()->id())->exists();
        
        return view('peserta.quizzes.show', compact('quiz', 'hasAttempted'));
    }

    public function start(Quiz $quiz)
    {
        if ($quiz->attempts()->where('user_id', auth()->id())->exists()) {
            return redirect()->route('peserta.quizzes.show', $quiz)
                ->with('error', 'You have already attempted this quiz.');
        }

        $quiz->load('questions.options');
        return view('peserta.quizzes.attempt', compact('quiz'));
    }

    public function submit(Request $request, Quiz $quiz)
    {
        if ($quiz->attempts()->where('user_id', auth()->id())->exists()) {
            return redirect()->route('peserta.quizzes.show', $quiz)
                ->with('error', 'You have already attempted this quiz.');
        }

        $request->validate([
            'answers' => 'required|array',
            'answers.*' => 'required|exists:options,id',
        ]);

        $attempt = $quiz->attempts()->create([
            'user_id' => auth()->id(),
        ]);

        $totalQuestions = $quiz->questions()->count();
        $correctAnswers = 0;

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

        $score = ($correctAnswers / $totalQuestions) * 100;
        $attempt->update([
            'score' => $score,
            'completed_at' => now(),
        ]);

        return redirect()->route('peserta.quizzes.result', $attempt)
            ->with('success', 'Quiz submitted successfully.');
    }

    public function result(QuizAttempt $attempt)
    {
        $attempt->load('quiz.questions.options', 'answers.option');
        return view('peserta.quizzes.result', compact('attempt'));
    }
}