<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $material->title }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #4361ee;
            --secondary-color: #3f37c9;
            --accent-color: #4895ef;
            --light-color: #f8f9fa;
            --dark-color: #212529;
            --success-color: #4cc9f0;
        }
        
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
            font-family: 'Poppins', sans-serif;
            background-color: #f5f7fa;
            color: var(--dark-color);
        }
        
        .content-container {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        
        .content-header {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 15px 25px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            position: fixed;
            width: 100%;
            z-index: 100;
            opacity: 0.9;
            transition: all 0.3s ease;
            backdrop-filter: blur(5px);
        }
        
        .content-header:hover {
            opacity: 1;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }
        
        .content-header h2 {
            margin: 0;
            font-size: 1.5rem;
        }
        
        .content-header .meta {
            display: flex;
            gap: 15px;
            margin-top: 5px;
            font-size: 0.9rem;
            opacity: 0.8;
        }
        
        .content-body {
            flex: 1;
            padding: 80px 20px 20px;
            max-width: 1200px;
            margin: 0 auto;
            width: 100%;
        }
        
        /* Styling untuk konten text */
        .text-content-container {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            padding: 30px;
            margin-bottom: 30px;
        }
        
        .text-content {
            line-height: 1.8;
            font-size: 1.1rem;
            color: #444;
        }
        
        .text-content h2, .text-content h3 {
            color: var(--primary-color);
            margin-top: 1.5em;
        }
        
        .text-content p {
            margin-bottom: 1.5em;
        }
        
        .text-content a {
            color: var(--accent-color);
            text-decoration: none;
            font-weight: 600;
        }
        
        .text-content a:hover {
            text-decoration: underline;
        }
        
        /* Styling untuk dokumen Word */
        .docx-container {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            padding: 30px;
            margin-bottom: 30px;
            min-height: 80vh;
        }
        
        .docx-viewer {
            width: 100%;
            height: 80vh;
            border: 1px solid #e0e0e0;
            border-radius: 5px;
        }
        
        /* Tombol download */
        .download-btn {
            position: fixed;
            bottom: 30px;
            right: 30px;
            z-index: 1000;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 12px 20px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            box-shadow: 0 4px 15px rgba(67, 97, 238, 0.3);
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
        }
        
        .download-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(67, 97, 238, 0.4);
        }
        
        .download-btn i {
            font-size: 1.2rem;
        }
        
        /* Responsif */
        @media (max-width: 768px) {
            .content-body {
                padding: 70px 15px 15px;
            }
            
            .text-content-container, .docx-container {
                padding: 20px;
            }
            
            .download-btn {
                bottom: 20px;
                right: 20px;
                padding: 10px 15px;
                font-size: 0.9rem;
            }
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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

    <script>
        // Auto hide header setelah 5 detik
        let header = document.querySelector('.content-header');
        let timeout;
        
        function hideHeader() {
            header.style.opacity = '0';
        }
        
        function resetTimer() {
            clearTimeout(timeout);
            header.style.opacity = '0.9';
            timeout = setTimeout(hideHeader, 5000);
        }
        
        // Set timer awal
        timeout = setTimeout(hideHeader, 5000);
        
        // Reset timer saat mouse bergerak
        document.addEventListener('mousemove', resetTimer);
        document.addEventListener('scroll', resetTimer);
        
        // Tampilkan header saat dihover
        header.addEventListener('mouseenter', () => {
            clearTimeout(timeout);
            header.style.opacity = '0.9';
        });
        
        header.addEventListener('mouseleave', () => {
            timeout = setTimeout(hideHeader, 1000);
        });
    </script>
</body>
</html>