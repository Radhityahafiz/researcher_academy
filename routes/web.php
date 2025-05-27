<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\StudentController;
use App\Http\Middleware\CheckRole;

// Halaman awal (Welcome)
Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

// Grup route untuk user yang sudah login & verifikasi email
Route::middleware(['auth', 'verified'])->group(function () {
    
    // Dashboard - hanya untuk mentor
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard')
        ->middleware(CheckRole::class . ':mentor');

    // Grup route khusus mentor/admin
    Route::middleware(CheckRole::class . ':mentor')->group(function () {
        // Materials management - kecuali show
        Route::resource('materials', MaterialController::class)->except(['show']);
        
        // Videos management - kecuali show
        Route::resource('videos', VideoController::class)->except(['show']);

        // Categories management
        Route::resource('categories', CategoryController::class);

        // Quiz Questions management
        Route::get('/quizzes/{quiz}/questions/create', [QuizController::class, 'createQuestion'])
            ->name('quizzes.questions.create');
        Route::post('/quizzes/{quiz}/questions', [QuizController::class, 'storeQuestion'])
            ->name('quizzes.questions.store');
        Route::get('/quizzes/{quiz}/questions/{question}/edit', [QuizController::class, 'editQuestion'])
            ->name('quizzes.questions.edit');
        Route::put('/quizzes/{quiz}/questions/{question}', [QuizController::class, 'updateQuestion'])
            ->name('quizzes.questions.update');
        Route::delete('/quizzes/{quiz}/questions/{question}', [QuizController::class, 'destroyQuestion'])
            ->name('quizzes.questions.destroy');

        // Add this new route
    Route::get('/students', [StudentController::class, 'index'])->name('students.index');    
    });

    // Quizzes - untuk semua user yang sudah login
    Route::resource('quizzes', QuizController::class);
    Route::get('/quizzes/{quiz}/start', [QuizController::class, 'startQuiz'])->name('quizzes.start');
    Route::post('/quizzes/{quiz}/submit', [QuizController::class, 'submitQuiz'])->name('quizzes.submit');
    Route::get('/quizzes/{attempt}/result', [QuizController::class, 'quizResult'])->name('quizzes.result');

    // Route untuk melihat materi dan video (admin/mentor view)
    Route::middleware(CheckRole::class . ':mentor')->group(function () {
        Route::get('/admin/materials/{material}', [MaterialController::class, 'show'])
            ->name('materials.show');
        
        Route::get('/admin/videos/{video}', [VideoController::class, 'show'])
            ->name('videos.show');
    });
});

// Route profile - untuk semua user login
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route khusus peserta
Route::middleware(['auth'])->group(function () {
    Route::get('/materials/{material}', [ParticipantController::class, 'showMaterial'])
        ->name('participant.materials.show');

    Route::get('/videos/{video}', [ParticipantController::class, 'showVideo'])
        ->name('participant.videos.show');

    Route::get('/category/{category}/materials', [ParticipantController::class, 'categoryMaterials'])
        ->name('participant.category.materials');

Route::prefix('participant')->group(function () {
    Route::get('/quizzes', [ParticipantController::class, 'quizIndex'])
        ->name('participant.quizzes.index');
    Route::get('/quizzes/{quiz}', [ParticipantController::class, 'showQuiz'])
        ->name('participant.quizzes.show');
    Route::get('/quizzes/{quiz}/start', [ParticipantController::class, 'startQuiz'])
        ->name('participant.quizzes.start');
    Route::post('/quizzes/{quiz}/submit', [ParticipantController::class, 'submitQuiz'])
        ->name('participant.quizzes.submit');
    Route::get('/quizzes/{attempt}/result', [ParticipantController::class, 'quizResult'])
        ->name('participant.quizzes.result');
    Route::post('/quizzes/{quiz}/save-progress', [ParticipantController::class, 'saveProgress'])->name('participant.quizzes.save-progress');
    
});
});

// Route auth bawaan dari Laravel Breeze / UI
require __DIR__.'/auth.php';