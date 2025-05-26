@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid px-md-4">
<link href="{{ asset('Backend/css/sb-admin-2.css') }}" rel="stylesheet">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Selamat Datang, {{ auth()->user()->full_name }}</h1>
    </div>

    <div class="row flex-nowrap overflow-auto">
        @php
            $cards = [];

            if (auth()->user()->isMentor()) {
                $cards = [
                    ['title' => 'Materials', 'icon' => 'book', 'count' => auth()->user()->materials()->count(), 'route' => route('materials.index')],
                    ['title' => 'Videos', 'icon' => 'video', 'count' => auth()->user()->videos()->count(), 'route' => route('videos.index')],
                    ['title' => 'Quizzes', 'icon' => 'question-circle', 'count' => auth()->user()->quizzes()->count(), 'route' => route('quizzes.index')],
                ];
            } else {
                $cards = [
                    ['title' => 'Materials', 'icon' => 'book', 'count' => \App\Models\Material::count(), 'route' => route('materials.index')],
                    ['title' => 'Quizzes', 'icon' => 'question-circle', 'count' => \App\Models\Quiz::count(), 'route' => route('quizzes.index')],
                ];
            }
        @endphp

        @foreach ($cards as $card)
            <div class="col-xl-3 col-md-6 mb-4 px-2" style="min-width: 250px;">
                <a href="{{ $card['route'] }}" class="text-decoration-none position-relative card-link">
                    <div class="card bg-white bg-opacity-75 shadow-sm rounded-3 border-0 h-100 transition card-hover">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div>
                                    <h6 class="text-muted text-uppercase small">{{ $card['title'] }}</h6>
                                    <h4 class="font-weight-bold mb-0 text-dark">{{ $card['count'] }}</h4>
                                </div>
                                <i class="fas fa-{{ $card['icon'] }} fa-2x text-gray-300"></i>
                            </div>
                        </div>
                        <div class="hover-overlay">
                            Klik untuk lihat detail <i class="fas fa-arrow-right"></i>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach

        @if (!auth()->user()->isMentor())
            <div class="col-xl-3 col-md-6 mb-4 px-2" style="min-width: 250px;">
                <div class="card bg-white bg-opacity-75 shadow-sm rounded-3 border-0 h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <h6 class="text-muted text-uppercase small">Learning Progress</h6>
                                <div class="h5 font-weight-bold text-dark">50%</div>
                            </div>
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                        <div class="progress progress-sm">
                            <div class="progress-bar bg-info" style="width: 50%;" role="progressbar"
                                aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('Backend/vendor/chart.js/Chart.min.js') }}"></script>
<script src="{{ asset('Backend/js/demo/chart-area-demo.js') }}"></script>
<script src="{{ asset('Backend/js/demo/chart-pie-demo.js') }}"></script>
@endpush
