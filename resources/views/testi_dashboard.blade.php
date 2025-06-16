@extends('layouts.app')

@section('title', 'Kelola Testimoni')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Kelola Testimoni</h6>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
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
                                        <td>{{ $loop->iteration }}</td>
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
                                                {{ ucfirst($testimonial->status) }}
                                            </span>
                                        </td>
                                        <td>{{ $testimonial->created_at->format('d/m/Y') }}</td>
                                        <td>
                                            <a href="{{ route('testimonials.show', $testimonial) }}" class="btn btn-sm btn-info" title="Detail">
                                                <i class="fas fa-eye"></i>
                                            </a>

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

                                            <form action="{{ route('testimonials.destroy', $testimonial) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus testimoni ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">Belum ada testimoni.</td>
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
    </div>
</div>
@endsection