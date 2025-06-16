@extends('layouts.app')

@section('title', 'Detail Penugasan: ' . $assignment->title)

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Detail Penugasan: {{ $assignment->title }}</h6>
                    <a href="{{ route('assignments.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h5>Detail</h5>
                            <ul class="list-unstyled">
                                <li><strong>Kategori:</strong> {{ $assignment->category->name }}</li>
                                <li><strong>Batas Waktu:</strong> 
                                    <span class="{{ $assignment->isPastDue() ? 'text-danger' : '' }}">
                                        {{ $assignment->due_date->format('d M Y H:i') }}
                                    </span>
                                </li>
                                <li><strong>Nilai Maksimal:</strong> {{ $assignment->max_score }}</li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <h5>Deskripsi</h5>
                        <div class="border p-3 bg-light">
                            {!! $assignment->description !!}
                        </div>
                    </div>

                    <div class="mb-4">
                        @if($assignment->file_path)
                            <a href="{{ $assignment->file_url }}" class="btn btn-primary" target="_blank">
                                <i class="fas fa-download"></i> Unduh File Tugas
                            </a>
                        @elseif($assignment->external_link)
                            <a href="{{ $assignment->external_link }}" class="btn btn-primary" target="_blank">
                                <i class="fas fa-external-link-alt"></i> Buka Link Tugas
                            </a>
                        @endif
                    </div>

                    <div class="card mt-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Pengumpulan</h5>
                        <div>
                             <a href="{{ route('assignments.export', $assignment) }}" class="btn btn-sm btn-success">
                                 <i class="fas fa-download"></i> Export Nilai (CSV)
                            </a>
                            <span class="badge bg-primary ms-2">{{ $submissions->total() }} Pengumpulan</span>
                        </div>
                    </div>
                        <div class="card-body">
                            @if($submissions->isEmpty())
                                <p class="text-muted">Belum ada pengumpulan</p>
                            @else
                                <div class="table-responsive">
                                    <table class="table table-bordered" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Peserta</th>
                                                <th>Tanggal Kumpul</th>
                                                <th>Status</th>
                                                <th>Nilai</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($submissions as $submission)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $submission->user->full_name }}</td>
                                                <td>
                                                    @if(!empty($submission->submitted_at))
                                                        {{ \Carbon\Carbon::parse($submission->submitted_at)->format('d M Y H:i') }}
                                                    @else
                                                        -
                                                    @endif
                                                </td>
                                                <td>
                                                    <span class="badge bg-{{ $submission->passed() ? 'success' : ($submission->score !== null ? 'danger' : ($submission->submitted_at ? 'info' : 'warning')) }}">
                                                        {{ $submission->status }}
                                                    </span>
                                                </td>
                                                <td>
                                                    @if($submission->score !== null)
                                                        {{ $submission->score }}/{{ $assignment->max_score }}
                                                    @else
                                                        -
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('assignments.submission', $submission) }}" class="btn btn-sm btn-info">
                                                        <i class="fas fa-eye"></i> Detail
                                                    </a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                {{ $submissions->links() }}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection