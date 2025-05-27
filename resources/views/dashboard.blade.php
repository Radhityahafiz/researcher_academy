@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid px-md-4">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Welcome, {{ auth()->user()->full_name }}</h1>
    </div>

    <!-- Content Row -->
    <div class="row justify-content-center">

        @if(auth()->user()->isMentor())
            <!-- Materials Card -->
            <div class="col-xl-3 col-md-6 mb-4 px-2">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Materials</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ auth()->user()->materials()->count() }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-book fa-2x text-gray-300"></i>
                            </div>
                        </div>
                        <a href="{{ route('materials.index') }}" class="small-box-footer mt-2">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>

            <!-- Videos Card -->
            <div class="col-xl-3 col-md-6 mb-4 px-2">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Videos</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ auth()->user()->videos()->count() }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-video fa-2x text-gray-300"></i>
                            </div>
                        </div>
                        <a href="{{ route('videos.index') }}" class="small-box-footer mt-2">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>

            <!-- Quizzes Card -->
            <div class="col-xl-3 col-md-6 mb-4 px-2">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    Quizzes</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ auth()->user()->quizzes()->count() }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-question-circle fa-2x text-gray-300"></i>
                            </div>
                        </div>
                        <a href="{{ route('quizzes.index') }}" class="small-box-footer mt-2">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </a>
            </div>

            <!-- Students Card -->
            
        @else
            <!-- Materials Card -->
            <div class="col-xl-3 col-md-6 mb-4 px-2">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Materials</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ \App\Models\Material::count() }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-book fa-2x text-gray-300"></i>
                            </div>
                        </div>
                        <a href="{{ route('materials.index') }}" class="small-box-footer mt-2">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>

            <!-- Quizzes Card -->
            <div class="col-xl-3 col-md-6 mb-4 px-2">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Quizzes</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ \App\Models\Quiz::count() }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-question-circle fa-2x text-gray-300"></i>
                            </div>
                        </div>
                        <a href="{{ route('quizzes.index') }}" class="small-box-footer mt-2">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>

            <!-- Progress Card -->
            <div class="col-xl-3 col-md-6 mb-4 px-2">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Learning Progress
                                </div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">50%</div>
                                    </div>
                                    <div class="col">
                                        <div class="progress progress-sm mr-2">
                                            <div class="progress-bar bg-info" role="progressbar"
                                                style="width: 50%" aria-valuenow="50" aria-valuemin="0"
                                                aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                            </div>
                        </div>
                        <a href="#" class="small-box-footer mt-3">
                            View Progress <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Completed Courses Card -->
            
        @endif

    </div>
</div>
@endsection

@push('scripts')
<!-- Page level plugins -->
<script src="{{ asset('Backend/vendor/chart.js/Chart.min.js') }}"></script>

<!-- Page level custom scripts -->
<script src="{{ asset('Backend/js/demo/chart-area-demo.js') }}"></script>
<script src="{{ asset('Backend/js/demo/chart-pie-demo.js') }}"></script>
@endpush