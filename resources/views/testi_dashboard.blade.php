@extends('layouts.app')

@section('title', 'Kelola Testimoni')

@section('content')
<div class="container-fluid py-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Kelola Testimoni</h4>
        </div>
        
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Rating</th>
                            <th>Testimoni</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($testimonials as $testimonial)
                            <tr>
                                <td>{{ $testimonial->user->full_name }}</td>
                                <td>
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-star {{ $i <= $testimonial->rating ? 'text-warning' : 'text-secondary' }}"></i>
                                    @endfor
                                </td>
                                <td>{{ Str::limit($testimonial->content, 50) }}</td>
                                <td>
                                    <span class="badge 
                                        {{ $testimonial->status == 'approved' ? 'badge-success' : 
                                           ($testimonial->status == 'rejected' ? 'badge-danger' : 'badge-warning') }}">
                                        {{ $testimonial->status }}
                                    </span>
                                </td>
                                <td>{{ $testimonial->created_at->format('d/m/Y') }}</td>
                                <td>
                                    @if($testimonial->status != 'approved')
                                        <a href="{{ route('testimonials.approve', $testimonial) }}" class="btn btn-sm btn-success" title="Setujui">
                                            <i class="fas fa-check"></i>
                                        </a>
                                    @endif
                                    
                                    @if($testimonial->status != 'rejected')
                                        <a href="{{ route('testimonials.reject', $testimonial) }}" class="btn btn-sm btn-danger" title="Tolak">
                                            <i class="fas fa-times"></i>
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Belum ada testimoni.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center mt-4">
                {{ $testimonials->links() }}
            </div>
        </div>
    </div>
</div>
@endsection