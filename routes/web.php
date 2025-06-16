<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    DashboardController,
    MaterialController,
    VideoController,
    CategoryController,
    ProfileController,
    WelcomeController,
    ParticipantController,
    StudentController,
    ProgressController,
    TestimonialController,
    AssignmentController
};
use App\Http\Controllers\Participant\AssignmentController as ParticipantAssignmentController;
use App\Http\Controllers\Participant\CategoryController as ParticipantCategoryController;
use App\Http\Controllers\Participant\ProfileController as ParticipantProfileController;
use App\Http\Middleware\CheckRole;

// Halaman awal
Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

// Grup route untuk user yang sudah login & verifikasi email
Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard - hanya untuk mentor
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard')
        ->middleware(CheckRole::class . ':mentor');

    /**
     * ================= Mentor/Admin Routes =================
     */
    Route::middleware(CheckRole::class . ':mentor')->group(function () {
        // CRUD: Materials & Videos (tanpa show)
        Route::resource('materials', MaterialController::class)->except(['show']);
        Route::resource('videos', VideoController::class)->except(['show']);
        Route::resource('categories', CategoryController::class);

        // Students
        Route::get('/students', [StudentController::class, 'index'])->name('students.index');
        Route::get('/students/create', [StudentController::class, 'create'])->name('students.create');
        Route::post('/students', [StudentController::class, 'store'])->name('students.store');
        Route::get('/students/{student}/edit', [StudentController::class, 'edit'])->name('students.edit');
        Route::put('/students/{student}', [StudentController::class, 'update'])->name('students.update');
        Route::delete('/students/{student}', [StudentController::class, 'destroy'])->name('students.destroy');
        Route::post('/students/{student}/toggle-status', [StudentController::class, 'toggleStatus'])->name('students.toggle-status');
        Route::get('/students/export', [StudentController::class, 'exportCSV'])->name('students.export');

        // Show Material & Video via admin panel
        Route::get('/admin/materials/{material}', [MaterialController::class, 'show'])->name('materials.show');
        Route::get('/admin/videos/{video}', [VideoController::class, 'show'])->name('videos.show');

        // Testimonial management
        Route::prefix('admin/testimonials')->group(function () {
            Route::get('/', [TestimonialController::class, 'dashboard'])->name('testimonials.dashboard');
            Route::get('/{testimonial}', [TestimonialController::class, 'show'])->name('testimonials.show');
            Route::get('/{testimonial}/approve', [TestimonialController::class, 'approve'])->name('testimonials.approve');
            Route::get('/{testimonial}/reject', [TestimonialController::class, 'reject'])->name('testimonials.reject');
            Route::delete('/{testimonial}', [TestimonialController::class, 'destroy'])->name('testimonials.destroy');
        });

        // Assignments (mentor)
        Route::resource('assignments', AssignmentController::class);
        Route::post('/assignments/{submission}/grade', [AssignmentController::class, 'gradeSubmission'])->name('assignments.grade');
        Route::get('/assignments/submissions/{submission}', [AssignmentController::class, 'showSubmission'])->name('assignments.submission')->middleware(['auth', CheckRole::class . ':mentor']);
        Route::get('/assignments/{assignment}/export', [AssignmentController::class, 'export'])->name('assignments.export');
    });

    /**
     * ================= Profile Routes =================
     */
    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    Route::prefix('participant')->middleware(['auth', CheckRole::class . ':peserta'])->group(function () {
    Route::get('/profile', [ParticipantProfileController::class, 'edit'])->name('participant.profile.edit');
    Route::patch('/profile', [ParticipantProfileController::class, 'update'])->name('participant.profile.update');
    Route::delete('/profile', [ParticipantProfileController::class, 'destroy'])->name('participant.profile.destroy');
});

    /**
     * ================= Participant Routes =================
     */
    Route::prefix('participant')->middleware(CheckRole::class . ':peserta', 'status')->group(function () {
        // Materials & Videos
        Route::get('/materials', [ParticipantController::class, 'materialIndex'])->name('participant.materials.index');
        Route::get('/videos', [ParticipantController::class, 'videoIndex'])->name('participant.videos.index');
        Route::get('/materials/{material}', [ParticipantController::class, 'showMaterial'])->name('participant.materials.show');
        Route::get('/videos/{video}', [ParticipantController::class, 'showVideo'])->name('participant.videos.show');

        // Assignments (peserta)
        Route::get('/assignments', [ParticipantAssignmentController::class, 'index'])->name('participant.assignments.index');
        Route::get('/assignments/{assignment}', [ParticipantAssignmentController::class, 'show'])->name('participant.assignments.show');
        Route::post('/assignments/{assignment}/submit', [ParticipantAssignmentController::class, 'submit'])->name('participant.assignments.submit');

        // Categories
        Route::get('/categories/{category}', [ParticipantCategoryController::class, 'show'])->name('participant.categories.show');
        Route::get('/category/{category}/materials', [ParticipantController::class, 'categoryMaterials'])->name('participant.category.materials');
    });

    /**
     * ================= Progress Routes =================
     */
    Route::prefix('progress')->middleware(CheckRole::class . ':peserta', 'status')->group(function () {
        Route::get('/', [ProgressController::class, 'index'])->name('progress.index');
        Route::get('/materials', [ProgressController::class, 'showMaterials'])->name('progress.materials');
        Route::get('/videos', [ProgressController::class, 'showVideos'])->name('progress.videos');
           Route::get('/assignments', [ProgressController::class, 'showAssignments'])->name('progress.assignments');
    });

    /**
     * ================= Testimonial Routes (Participant) =================
     */
    Route::prefix('testimonials')->middleware(CheckRole::class . ':peserta', 'status')->group(function () {
        Route::get('/', [TestimonialController::class, 'index'])->name('testimonials.index');
        Route::get('/create', [TestimonialController::class, 'create'])->name('testimonials.create');
        Route::post('/', [TestimonialController::class, 'store'])->name('testimonials.store');
        Route::get('/{testimonial}/edit', [TestimonialController::class, 'edit'])->name('testimonials.edit');
        Route::put('/{testimonial}', [TestimonialController::class, 'update'])->name('testimonials.update');
    });

});

// Route auth bawaan Laravel Breeze
require __DIR__ . '/auth.php';
