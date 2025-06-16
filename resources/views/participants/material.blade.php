<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $material->title }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="{{ asset('frontend/assets/css/participants.css') }}" rel="stylesheet">
</head>
<body>
    <div class="content-container">
        <div class="content-header">
            <h2>{{ $material->title }}</h2>
            <div class="meta">
                <span><i class="fas fa-folder"></i> {{ $material->category->name }}</span>
                @if($material->description)
                    <span><i class="fas fa-info-circle"></i> {{ $material->description }}</span>
                @endif
            </div>
        </div>
        
        <div class="content-body">
            @if($material->content_type === 'file')
                @if(pathinfo($material->file_path, PATHINFO_EXTENSION) === 'pdf')
                    <iframe class="docx-viewer" src="{{ Storage::url($material->file_path) }}"></iframe>
                @elseif(in_array(pathinfo($material->file_path, PATHINFO_EXTENSION), ['docx', 'doc']))
                    <div class="docx-container">
                        <h3><i class="fas fa-file-word"></i> Dokumen Word</h3>
                        <p>Dokumen ini tidak dapat ditampilkan secara langsung. Silakan download untuk melihat isinya.</p>
                        <iframe class="docx-viewer" src="https://view.officeapps.live.com/op/embed.aspx?src={{ urlencode(Storage::url($material->file_path)) }}"></iframe>
                    </div>
                @else
                    <div class="docx-container">
                        <h3><i class="fas fa-file"></i> File Materi</h3>
                        <p>File tidak dapat ditampilkan langsung. Silakan download untuk melihat isinya.</p>
                    </div>
                @endif
            @elseif($material->content_type === 'text')
                <div class="text-content-container">
                    <h2>{{ $material->title }}</h2>
                    @if($material->description)
                        <p class="text-muted"><i>{{ $material->description }}</i></p>
                    @endif
                    <div class="text-content">
                        {!! nl2br(e($material->content)) !!}
                    </div>
                </div>
            @endif
        </div>
    </div>

    @if($material->content_type === 'file')
        <a href="{{ Storage::url($material->file_path) }}" class="download-btn" download>
            <i class="fas fa-download"></i> Download File
        </a>
    @endif

    <script src="{{ asset('frontend/assets/js/new.js') }}"></script>

</body>
</html>