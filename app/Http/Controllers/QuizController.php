<?php

namespace App\Http\Controllers;

use App\Models\Option;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\QuizAttempt;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function index()
    {
        $quizzes = Quiz::with('creator')->latest()->get();
        return view('quizzes.index', compact('quizzes'));
    }

    public function create()
    {
        return view('quizzes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:100',
            'description' => 'nullable|string',
            'passing_score' => 'required|integer|min:0|max:100',
        ]);

        Quiz::create([
            'title' => $request->title,
            'description' => $request->description,
            'passing_score' => $request->passing_score,
            'created_by' => auth()->id(),
        ]);

        return redirect()->route('quizzes.index')->with('success', 'Quiz created successfully.');
    }

    public function show(Quiz $quiz)
    {
        $quiz->load('questions.options');
        return view('quizzes.show', compact('quiz'));
    }

    public function edit(Quiz $quiz)
    {
        return view('quizzes.edit', compact('quiz'));
    }

    public function update(Request $request, Quiz $quiz)
    {
        $request->validate([
            'title' => 'required|string|max:100',
            'description' => 'nullable|string',
            'passing_score' => 'required|integer|min:0|max:100',
        ]);

        $quiz->update([
            'title' => $request->title,
            'description' => $request->description,
            'passing_score' => $request->passing_score,
        ]);

        return redirect()->route('quizzes.index')->with('success', 'Quiz updated successfully.');
    }

    public function destroy(Quiz $quiz)
    {
        $quiz->delete();
        return redirect()->route('quizzes.index')->with('success', 'Quiz deleted successfully.');
    }

    public function createQuestion(Quiz $quiz)
    {
        return view('quizzes.questions.create', compact('quiz'));
    }

    public function storeQuestion(Request $request, Quiz $quiz)
    {
        $request->validate([
            'question_text' => 'required|string',
            'question_type' => 'required|in:multiple_choice,true_false',
            'points' => 'required|integer|min:1',
            'options' => 'required|array|min:2',
            'options.*.text' => 'required|string',
            'correct_option' => 'required|integer',
        ]);

        $question = $quiz->questions()->create([
            'question_text' => $request->question_text,
            'question_type' => $request->question_type,
            'points' => $request->points,
        ]);

        foreach ($request->options as $index => $option) {
            $question->options()->create([
                'option_text' => $option['text'],
                'is_correct' => $index == $request->correct_option,
            ]);
        }

        return redirect()->route('quizzes.show', $quiz)->with('success', 'Question added successfully.');
    }

    public function editQuestion(Quiz $quiz, Question $question)
    {
        $question->load('options');
        return view('quizzes.questions.edit', compact('quiz', 'question'));
    }

    public function updateQuestion(Request $request, Quiz $quiz, Question $question)
    {
        $request->validate([
            'question_text' => 'required|string',
            'question_type' => 'required|in:multiple_choice,true_false',
            'points' => 'required|integer|min:1',
            'options' => 'required|array|min:2',
            'options.*.text' => 'required|string',
            'options.*.id' => 'nullable|exists:options,id',
            'correct_option' => 'required|integer',
        ]);

        $question->update([
            'question_text' => $request->question_text,
            'question_type' => $request->question_type,
            'points' => $request->points,
        ]);

        // Update or create options
        foreach ($request->options as $index => $optionData) {
            $optionData['is_correct'] = $index == $request->correct_option;
            
            if (isset($optionData['id'])) {
                $option = Option::find($optionData['id']);
                $option->update([
                    'option_text' => $optionData['text'],
                    'is_correct' => $optionData['is_correct'],
                ]);
            } else {
                $question->options()->create([
                    'option_text' => $optionData['text'],
                    'is_correct' => $optionData['is_correct'],
                ]);
            }
        }

        return redirect()->route('quizzes.show', $quiz)->with('success', 'Question updated successfully.');
    }

    public function destroyQuestion(Quiz $quiz, Question $question)
    {
        $question->delete();
        return redirect()->route('quizzes.show', $quiz)->with('success', 'Question deleted successfully.');
    }

    public function startQuiz(Quiz $quiz)
    {
        if ($quiz->attempts()->where('user_id', auth()->id())->exists()) {
            return redirect()->route('quizzes.show', $quiz)->with('error', 'You have already attempted this quiz.');
        }

        return view('quizzes.attempt', compact('quiz'));
    }

    public function submitQuiz(Request $request, Quiz $quiz)
    {
        if ($quiz->attempts()->where('user_id', auth()->id())->exists()) {
            return redirect()->route('quizzes.show', $quiz)->with('error', 'You have already attempted this quiz.');
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

        return redirect()->route('quizzes.result', $attempt)->with('success', 'Quiz submitted successfully.');
    }

    public function quizResult(QuizAttempt $attempt)
    {
        $attempt->load('quiz.questions.options', 'answers.option');
        return view('quizzes.result', compact('attempt'));
    }
}