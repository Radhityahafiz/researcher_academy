<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $video->title }}</title>
    <style>
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
            overflow: hidden;
            font-family: Arial, sans-serif;
            background: black;
        }
        .video-container {
            height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .video-header {
            background: rgba(0,0,0,0.7);
            color: white;
            padding: 10px 15px;
            position: fixed;
            width: 100%;
            z-index: 100;
            opacity: 0;
            transition: opacity 0.3s;
        }
        .video-header:hover {
            opacity: 1;
        }
        .video-player {
            flex: 1;
            position: relative;
        }
        .video-frame {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: none;
        }
        .close-btn {
            position: fixed;
            top: 10px;
            right: 10px;
            z-index: 1000;
            background: rgba(0,0,0,0.5);
            color: white;
            border: none;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            font-size: 16px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <button class="close-btn" onclick="window.close()">×</button>
    
    <div class="video-container">
        <div class="video-header">
            <h2>{{ $video->title }}</h2>
            @if($video->description)
                <p>{{ $video->description }}</p>
            @endif
        </div>
        
        <div class="video-player">
            @if($videoId)
                @if(str_contains($video->video_link, 'youtube'))
                    <iframe class="video-frame" 
                            src="https://www.youtube.com/embed/{{ $videoId }}?autoplay=1&rel=0" 
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                            allowfullscreen></iframe>
                @elseif(str_contains($video->video_link, 'vimeo'))
                    <iframe class="video-frame" 
                            src="https://player.vimeo.com/video/{{ $videoId }}?autoplay=1" 
                            allow="autoplay; fullscreen" 
                            allowfullscreen></iframe>
                @else
                    <iframe class="video-frame" 
                            src="{{ $video->video_link }}" 
                            allowfullscreen></iframe>
                @endif
            @else
                <iframe class="video-frame" 
                        src="{{ $video->video_link }}" 
                        allowfullscreen></iframe>
            @endif
        </div>
    </div>

    <script>
        // Sembunyikan header setelah 3 detik
        setTimeout(() => {
            document.querySelector('.video-header').style.opacity = '0';
        }, 3000);

        // Tutup window dengan ESC
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                window.close();
            }
        });
    </script>
</body>
</html>