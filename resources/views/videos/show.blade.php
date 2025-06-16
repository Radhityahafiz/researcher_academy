@extends('layouts.app')

@section('title', $video->title)

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">{{ $video->title }}</h6>
                    <div>
                        <a href="{{ route('videos.edit', $video) }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h5>Detail</h5>
                            <ul class="list-unstyled">
                                <li><strong>Dibuat Oleh:</strong> {{ $video->creator->full_name }}</li>
                                <li><strong>Tanggal Dibuat:</strong> {{ $video->created_at->format('d M Y, H:i') }}</li>
                                <li><strong>Kategori:</strong> {{ $video->category->name ?? 'Tidak berkategori' }}</li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <h5>Deskripsi</h5>
                        <p>{{ $video->description ?? 'Tidak ada deskripsi' }}</p>
                    </div>
                    
                    <div class="mb-4">
                        <h5>Video</h5>
                        <div class="ratio ratio-16x9">
                            <iframe src="{{ $video->video_link }}" allowfullscreen></iframe>
                        </div>
                    </div>
                    <a href="{{ route('videos.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection