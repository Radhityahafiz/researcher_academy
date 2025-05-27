<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Materi {{ $category->name }} - Research Academy</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        :root {
            --primary-color: #4361ee;
            --secondary-color: #3f37c9;
            --accent-color: #4895ef;
            --light-color: #f8f9fa;
            --dark-color: #212529;
        }
        
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #f5f7fa;
        }
        
        .breadcrumb {
            background-color: transparent;
            padding: 0;
        }
        
        .breadcrumb-item a {
            color: var(--primary-color);
            text-decoration: none;
        }
        
        .category-header {
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
            margin-bottom: 30px;
        }
        
        .material-card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
            height: 100%;
        }
        
        .material-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        
        .material-card .card-body {
            padding: 20px;
        }
        
        .material-card .card-title {
            font-weight: 600;
            color: var(--dark-color);
            margin-bottom: 10px;
        }
        
        .material-card .card-text {
            color: #6c757d;
            font-size: 0.9rem;
        }
        
        .material-card .badge {
            font-size: 0.75rem;
            font-weight: 500;
        }
        
        .material-card .btn {
            font-size: 0.85rem;
            padding: 5px 15px;
        }
        
        .pagination .page-item.active .page-link {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .pagination .page-link {
            color: var(--primary-color);
        }
        
        @media (max-width: 768px) {
            .category-header {
                padding: 15px;
            }
            
            .material-card {
                margin-bottom: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container py-4">
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('welcome') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('welcome') }}#materi">Materi Magang</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $category->name }}</li>
            </ol>
        </nav>

        <div class="category-header">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="d-flex align-items-center">
                        @if($category->thumbnail)
                        <img src="{{ $category->thumbnail_url }}" alt="{{ $category->name }}" 
                             class="rounded-circle me-3" style="width: 60px; height: 60px; object-fit: cover;">
                        @endif
                        <div>
                            <h2 class="mb-1">{{ $category->name }}</h2>
                            <p class="text-muted mb-0">{{ $materials->total() }} Materi Tersedia</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 text-md-end mt-3 mt-md-0">
                    <a href="{{ route('welcome') }}#materi" class="btn btn-outline-primary">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>
            
            @if($category->description)
            <div class="mt-3">
                <p class="lead">{{ $category->description }}</p>
            </div>
            @endif
        </div>

        <div class="row">
            @forelse($materials as $material)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card h-100 material-card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $material->title }}</h5>
                        @if($material->description)
                        <p class="card-text">{{ Str::limit($material->description, 100) }}</p>
                        @endif
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <span class="badge bg-light text-dark">
                                @if($material->content_type === 'file')
                                <i class="bi bi-file-earmark"></i> File
                                @elseif($material->content_type === 'link')
                                <i class="bi bi-link-45deg"></i> Link
                                @else
                                <i class="bi bi-text-paragraph"></i> Teks
                                @endif
                            </span>
                            <a href="{{ route('participant.materials.show', $material) }}" class="btn btn-sm btn-primary">
                                Buka Materi
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="alert alert-info text-center">
                    <i class="bi bi-info-circle"></i> Belum ada materi tersedia untuk kategori ini.
                </div>
            </div>
            @endforelse
        </div>

        @if($materials->hasPages())
        <div class="d-flex justify-content-center mt-4">
            {{ $materials->links() }}
        </div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>