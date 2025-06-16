@extends('layouts.app')

@section('title', 'Beranda Mentor')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid px-lg-4">

    <!-- Welcome Header -->
    <div class="welcome-header">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="h4 mb-2 font-weight-bold text-primary">Selamat Datang, {{ auth()->user()->full_name }}</h1>
                <p class="mb-0 text-muted">
                    @if(auth()->user()->isMentor())
                        Berikut ringkasan pengajaran Anda
                    @else
                        Lanjutkan perjalanan belajar Anda
                    @endif
                </p>
            </div>
            <div class="col-md-4 text-md-right">
                <span class="badge badge-primary p-2">
                    <i class="far fa-calendar-alt mr-2"></i>
                    {{ now()->format('F j, Y') }}
                </span>
            </div>
        </div>
    </div>

    <!-- Stats Row -->
    <div class="row">
        @if(auth()->user()->isMentor())
            <!-- Materials Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card stat-card stat-card-primary h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-uppercase text-muted mb-2">Materi</h6>
                                <h3 class="mb-0 font-weight-bold">{{ auth()->user()->materials()->count() }}</h3>
                            </div>
                            <div class="icon">
                                <i class="fas fa-book text-primary"></i>
                            </div>
                        </div>
                        <a href="{{ route('materials.index') }}" class="small-box-footer mt-3">
                            Lihat Materi <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Videos Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card stat-card stat-card-info h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-uppercase text-muted mb-2">Video</h6>
                                <h3 class="mb-0 font-weight-bold">{{ auth()->user()->videos()->count() }}</h3>
                            </div>
                            <div class="icon">
                                <i class="fas fa-video text-info"></i>
                            </div>
                        </div>
                        <a href="{{ route('videos.index') }}" class="small-box-footer mt-3">
                            Lihat Video <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Assignments Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card stat-card stat-card-primary h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-uppercase text-muted mb-2">Penugasan</h6>
                                <h3 class="mb-0 font-weight-bold">{{ auth()->user()->assignments()->count() }}</h3>
                            </div>
                            <div class="icon">
                                <i class="fas fa-tasks text-primary"></i>
                            </div>
                        </div>
                        <a href="{{ route('assignments.index') }}" class="small-box-footer mt-3">
                            Lihat Penugasan <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Students Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card stat-card stat-card-info h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-uppercase text-muted mb-2">Peserta</h6>
                                <h3 class="mb-0 font-weight-bold">{{ \App\Models\User::countPeserta() }}</h3>
                            </div>
                            <div class="icon">
                                <i class="fas fa-users text-info"></i>
                            </div>
                        </div>
                        <a href="{{ route('students.index') }}" class="small-box-footer mt-3">
                            Lihat Peserta <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                </div>
            </div>

        @else
            <!-- Materials Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card stat-card stat-card-primary h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-uppercase text-muted mb-2">Materials</h6>
                                <h3 class="mb-0 font-weight-bold">{{ \App\Models\Material::count() }}</h3>
                            </div>
                            <div class="icon">
                                <i class="fas fa-book text-primary"></i>
                            </div>
                        </div>
                        <a href="{{ route('materials.index') }}" class="small-box-footer mt-3">
                            View Materials <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Progress Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card stat-card stat-card-info h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-uppercase text-muted mb-2">Progress</h6>
                                <h3 class="mb-0 font-weight-bold">50%</h3>
                                <div class="progress mt-2">
                                    <div class="progress-bar bg-info" style="width: 50%"></div>
                                </div>
                            </div>
                            <div class="icon">
                                <i class="fas fa-chart-line text-info"></i>
                            </div>
                        </div>
                        <a href="#" class="small-box-footer mt-3">
                            View Progress <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Completed Courses Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card stat-card stat-card-success h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-uppercase text-muted mb-2">Completed</h6>
                                <h3 class="mb-0 font-weight-bold">3</h3>
                            </div>
                            <div class="icon">
                                <i class="fas fa-check-circle text-success"></i>
                            </div>
                        </div>
                        <a href="#" class="small-box-footer mt-3">
                            View Certificates <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Videos Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card stat-card stat-card-warning h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-uppercase text-muted mb-2">Videos</h6>
                                <h3 class="mb-0 font-weight-bold">{{ \App\Models\Video::count() }}</h3>
                            </div>
                            <div class="icon">
                                <i class="fas fa-video text-warning"></i>
                            </div>
                        </div>
                        <a href="{{ route('videos.index') }}" class="small-box-footer mt-3">
                            View Videos <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection