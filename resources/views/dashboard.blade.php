@extends('layouts.app')

@section('title', 'Dashboard')

@push('styles')
<style>
    .dashboard-container {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
        padding: 2rem 0;
    }

    .welcome-header {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        padding: 2rem;
        margin-bottom: 2rem;
        border: 1px solid rgba(255, 255, 255, 0.2);
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
    }

    .welcome-header h1 {
        color: white;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }

    .welcome-header p {
        color: rgba(255, 255, 255, 0.8);
        font-size: 1.1rem;
    }

    .date-badge {
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.3);
        color: white;
        padding: 0.75rem 1.5rem;
        border-radius: 50px;
        font-weight: 600;
    }

    .stat-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border: none;
        border-radius: 20px;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        overflow: hidden;
        position: relative;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--card-gradient));
        transition: height 0.3s ease;
    }

    .stat-card:hover::before {
        height: 8px;
    }

    .stat-card:hover {
        transform: translateY(-10px) scale(1.02);
        box-shadow: 0 25px 60px rgba(0, 0, 0, 0.15);
    }

    .stat-card-primary {
        --card-gradient: #667eea, #764ba2;
    }

    .stat-card-success {
        --card-gradient: #11998e, #38ef7d;
    }

    .stat-card-info {
        --card-gradient: #3b82f6, #1d4ed8;
    }

    .stat-card-warning {
        --card-gradient: #f093fb, #f5576c;
    }

    .card-body {
        padding: 2rem;
        position: relative;
        z-index: 2;
    }

    .stat-number {
        font-size: 2.5rem;
        font-weight: 800;
        background: linear-gradient(135deg, var(--card-gradient));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        line-height: 1;
        margin: 0.5rem 0;
    }

    .stat-label {
        font-size: 0.85rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: #6b7280;
        margin-bottom: 0.5rem;
    }

    .stat-icon {
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, var(--card-gradient));
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.5rem;
        transition: all 0.3s ease;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .stat-card:hover .stat-icon {
        transform: rotate(10deg) scale(1.1);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
    }

    .card-footer-link {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 1rem 2rem;
        background: rgba(0, 0, 0, 0.02);
        border-top: 1px solid rgba(0, 0, 0, 0.05);
        text-decoration: none;
        color: #374151;
        font-weight: 600;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .card-footer-link::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.8), transparent);
        transition: left 0.5s ease;
    }

    .stat-card:hover .card-footer-link::before {
        left: 100%;
    }

    .card-footer-link:hover {
        background: linear-gradient(135deg, var(--card-gradient));
        color: white;
        text-decoration: none;
    }

    .progress-modern {
        height: 8px;
        background: rgba(0, 0, 0, 0.1);
        border-radius: 50px;
        overflow: hidden;
        margin-top: 1rem;
    }

    .progress-bar-modern {
        height: 100%;
        background: linear-gradient(90deg, var(--card-gradient));
        border-radius: 50px;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .progress-bar-modern::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.5), transparent);
        animation: shimmer 2s infinite;
    }

    @keyframes shimmer {
        0% { transform: translateX(-100%); }
        100% { transform: translateX(100%); }
    }

    .fade-in-up {
        animation: fadeInUp 0.6s ease forwards;
        opacity: 0;
        transform: translateY(30px);
    }

    .fade-in-up:nth-child(1) { animation-delay: 0.1s; }
    .fade-in-up:nth-child(2) { animation-delay: 0.2s; }
    .fade-in-up:nth-child(3) { animation-delay: 0.3s; }
    .fade-in-up:nth-child(4) { animation-delay: 0.4s; }

    @keyframes fadeInUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @media (max-width: 768px) {
        .stat-card {
            margin-bottom: 1.5rem;
        }
        
        .welcome-header {
            text-align: center;
        }
        
        .date-badge {
            margin-top: 1rem;
        }
    }
</style>
@endpush

@section('content')
<div class="dashboard-container">
    <div class="container-fluid px-lg-4">
        <!-- Welcome Header -->
        <div class="welcome-header">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1 class="mb-2">Welcome back, {{ auth()->user()->full_name }}! 👋</h1>
                    <p class="mb-0">
                        @if(auth()->user()->isMentor())
                            Ready to inspire and teach today?
                        @else
                            Let's continue your amazing learning journey!
                        @endif
                    </p>
                </div>
                <div class="col-md-4 text-md-right">
                    <div class="date-badge">
                        <i class="far fa-calendar-alt mr-2"></i>
                        {{ now()->format('F j, Y') }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Row -->
        <div class="row">
            @if(auth()->user()->isMentor())
                <!-- Materials Card -->
                <div class="col-xl-3 col-md-6 mb-4 fade-in-up">
                    <div class="card stat-card stat-card-primary h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start">
                                <div class="flex-grow-1">
                                    <div class="stat-label">Materials Created</div>
                                    <div class="stat-number">{{ auth()->user()->materials()->count() }}</div>
                                    <small class="text-muted">
                                        <i class="fas fa-arrow-up text-success mr-1"></i>
                                        Materials is Coaching students
                                    </small>
                                </div>
                                <div class="stat-icon">
                                    <i class="fas fa-book"></i>
                                </div>
                            </div>
                        </div>
                        <a href="{{ route('materials.index') }}" class="card-footer-link">
                            <span>Manage Materials</span>
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>

                <!-- Videos Card -->
                <div class="col-xl-3 col-md-6 mb-4 fade-in-up">
                    <div class="card stat-card stat-card-success h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start">
                                <div class="flex-grow-1">
                                    <div class="stat-label">Video Content</div>
                                    <div class="stat-number">{{ auth()->user()->videos()->count() }}</div>
                                    <small class="text-muted">
                                        <i class="fas fa-play-circle text-success mr-1"></i>
                                        @if(Schema::hasColumn('videos', 'views'))
                                            {{ auth()->user()->videos()->sum('views') ?? 0 }} total views
                                        @else
                                            Ready to inspire students
                                        @endif
                                    </small>
                                </div>
                                <div class="stat-icon">
                                    <i class="fas fa-video"></i>
                                </div>
                            </div>
                        </div>
                        <a href="{{ route('videos.index') }}" class="card-footer-link">
                            <span>Manage Videos</span>
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>

                <!-- Quizzes Card -->
                <div class="col-xl-3 col-md-6 mb-4 fade-in-up">
                    <div class="card stat-card stat-card-info h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start">
                                <div class="flex-grow-1">
                                    <div class="stat-label">Quizzes Created</div>
                                    <div class="stat-number">{{ auth()->user()->quizzes()->count() }}</div>
                                    <small class="text-muted">
                                        <i class="fas fa-users text-info mr-1"></i>
                                        Challenge your students
                                    </small>
                                </div>
                                <div class="stat-icon">
                                    <i class="fas fa-question-circle"></i>
                                </div>
                            </div>
                        </div>
                        <a href="{{ route('quizzes.index') }}" class="card-footer-link">
                            <span>Manage Quizzes</span>
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>

                <!-- Students Card -->
                <div class="col-xl-3 col-md-6 mb-4 fade-in-up">
                    <div class="card stat-card stat-card-warning h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start">
                                <div class="flex-grow-1">
                                    <div class="stat-label">Active Students</div>
                                    <div class="stat-number">{{ \App\Models\User::countPeserta() }}</div>
                                    <small class="text-muted">
                                        <i class="fas fa-graduation-cap text-warning mr-1"></i>
                                        Inspiring minds daily
                                    </small>
                                </div>
                                <div class="stat-icon">
                                    <i class="fas fa-users"></i>
                                </div>
                            </div>
                        </div>
                        <a href="{{ route('students.index') }}" class="card-footer-link">
                            <span>View Students</span>
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            @else
                <!-- Materials Card -->
                <div class="col-xl-3 col-md-6 mb-4 fade-in-up">
                    <div class="card stat-card stat-card-primary h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start">
                                <div class="flex-grow-1">
                                    <div class="stat-label">Available Materials</div>
                                    <div class="stat-number">{{ \App\Models\Material::count() }}</div>
                                    <small class="text-muted">
                                        <i class="fas fa-book-open text-primary mr-1"></i>
                                        Ready to explore
                                    </small>
                                </div>
                                <div class="stat-icon">
                                    <i class="fas fa-book"></i>
                                </div>
                            </div>
                        </div>
                        <a href="{{ route('materials.index') }}" class="card-footer-link">
                            <span>Browse Materials</span>
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>

                <!-- Quizzes Card -->
                <div class="col-xl-3 col-md-6 mb-4 fade-in-up">
                    <div class="card stat-card stat-card-success h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start">
                                <div class="flex-grow-1">
                                    <div class="stat-label">Quizzes Available</div>
                                    <div class="stat-number">{{ \App\Models\Quiz::count() }}</div>
                                    <small class="text-muted">
                                        <i class="fas fa-brain text-success mr-1"></i>
                                        Test your knowledge
                                    </small>
                                </div>
                                <div class="stat-icon">
                                    <i class="fas fa-question-circle"></i>
                                </div>
                            </div>
                        </div>
                        <a href="{{ route('quizzes.index') }}" class="card-footer-link">
                            <span>Take Quizzes</span>
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>

                <!-- Progress Card -->
                <div class="col-xl-3 col-md-6 mb-4 fade-in-up">
                    <div class="card stat-card stat-card-info h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start">
                                <div class="flex-grow-1">
                                    <div class="stat-label">Learning Progress</div>
                                    <div class="stat-number">75%</div>
                                    <div class="progress-modern">
                                        <div class="progress-bar-modern" style="width: 75%"></div>
                                    </div>
                                    <small class="text-muted mt-2 d-block">
                                        <i class="fas fa-fire text-info mr-1"></i>
                                        You're on fire! 🔥
                                    </small>
                                </div>
                                <div class="stat-icon">
                                    <i class="fas fa-chart-line"></i>
                                </div>
                            </div>
                        </div>
                        <a href="#" class="card-footer-link">
                            <span>View Progress</span>
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>

                <!-- Achievements Card -->
                <div class="col-xl-3 col-md-6 mb-4 fade-in-up">
                    <div class="card stat-card stat-card-warning h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start">
                                <div class="flex-grow-1">
                                    <div class="stat-label">Certificates Earned</div>
                                    <div class="stat-number">5</div>
                                    <small class="text-muted">
                                        <i class="fas fa-trophy text-warning mr-1"></i>
                                        Amazing achievement!
                                    </small>
                                </div>
                                <div class="stat-icon">
                                    <i class="fas fa-award"></i>
                                </div>
                            </div>
                        </div>
                        <a href="#" class="card-footer-link">
                            <span>View Certificates</span>
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection