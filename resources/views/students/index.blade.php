@extends('layouts.app')

@section('title', 'Kelola Peserta')

@section('content')
<div class="container-fluid px-lg-4">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Manajemen Peserta</h1>
        @auth
            @if(auth()->user()->isMentor())
                <a href="{{ route('students.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Tambah Peserta
                </a>
            @endif
        @endauth
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Peserta</h6>
            <div>
                <span class="badge badge-primary mr-2">
                    Total Peserta: {{ $students->total() }}
                </span>
                @auth
                    @if(auth()->user()->isMentor())
                        <a href="{{ route('students.export') }}" class="btn btn-success btn-sm">
                            <i class="fas fa-file-export"></i> Export CSV
                        </a>
                    @endif
                @endauth
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>Nama Lengkap</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Mendaftar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($students as $index => $student)
                            <tr>
                                <td>{{ $index + $students->firstItem() }}</td>
                                <td>{{ $student->full_name }}</td>
                                <td>{{ $student->username }}</td>
                                <td>{{ $student->email }}</td>
                                <td>
                                    <span class="badge badge-{{ $student->status === 'active' ? 'success' : 'danger' }}">
                                        {{ ucfirst($student->status) }}
                                    </span>
                                </td>
                                <td>{{ $student->created_at->format('d M Y') }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('students.edit', $student->id) }}" 
                                           class="btn btn-sm btn-primary" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        
                                        <form action="{{ route('students.toggle-status', $student->id) }}" 
                                              method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-{{ $student->status === 'active' ? 'warning' : 'success' }}" 
                                                    title="{{ $student->status === 'active' ? 'Nonaktifkan' : 'Aktifkan' }}">
                                                <i class="fas fa-{{ $student->status === 'active' ? 'times' : 'check' }}"></i>
                                            </button>
                                        </form>
                                        
                                        <form action="{{ route('students.destroy', $student->id) }}" 
                                              method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" 
                                                    title="Hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus peserta ini?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Tidak ada peserta ditemukan</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="d-flex justify-content-center mt-4">
                {{ $students->links() }}
            </div>
        </div>
    </div>
</div>
@endsection