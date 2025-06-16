<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $video->title }}</title>
    <link href="{{ asset('frontend/assets/css/participants.css') }}" rel="stylesheet">
</head>
<body>
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

<script src="{{ asset('frontend/assets/js/new.js') }}"></script>

</body>
</html>