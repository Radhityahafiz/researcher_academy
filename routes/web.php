<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\CheckRole;

Route::get('/', function () {
    return view('welcome');
});


Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Materials (only for mentor)
    Route::resource('materials', MaterialController::class)->middleware(CheckRole::class . ':mentor');

    // Videos (only for mentor)
    Route::resource('videos', VideoController::class)->middleware(CheckRole::class . ':mentor');

    // Categories (only for mentor)
    Route::resource('categories', CategoryController::class)->middleware(CheckRole::class . ':mentor');

    // Quizzes (accessible to all logged-in users)
    Route::resource('quizzes', QuizController::class);
    Route::get('/quizzes/{quiz}/start', [QuizController::class, 'startQuiz'])->name('quizzes.start');
    Route::post('/quizzes/{quiz}/submit', [QuizController::class, 'submitQuiz'])->name('quizzes.submit');
    Route::get('/quizzes/{attempt}/result', [QuizController::class, 'quizResult'])->name('quizzes.result');

    // Quiz Questions (assuming only mentor can manage)
    Route::get('/quizzes/{quiz}/questions/create', [QuizController::class, 'createQuestion'])->name('quizzes.questions.create')->middleware(CheckRole::class . ':mentor');
    Route::post('/quizzes/{quiz}/questions', [QuizController::class, 'storeQuestion'])->name('quizzes.questions.store')->middleware(CheckRole::class . ':mentor');
    Route::get('/quizzes/{quiz}/questions/{question}/edit', [QuizController::class, 'editQuestion'])->name('quizzes.questions.edit')->middleware(CheckRole::class . ':mentor');
    Route::put('/quizzes/{quiz}/questions/{question}', [QuizController::class, 'updateQuestion'])->name('quizzes.questions.update')->middleware(CheckRole::class . ':mentor');
    Route::delete('/quizzes/{quiz}/questions/{question}', [QuizController::class, 'destroyQuestion'])->name('quizzes.questions.destroy')->middleware(CheckRole::class . ':mentor');
});

// Profile (only for authenticated users)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Auth routes (default from Breeze or Laravel UI)
require __DIR__.'/auth.php';
