@extends('parent.parentHome')

@section('contenueVideoSection')
<style>
    .video-container {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 1.5rem;
        padding: 2rem;
    }

    .video-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 0.75rem;
        padding: 1.5rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: transform 0.2s, box-shadow 0.2s;
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
    }

    .video-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 6px 10px rgba(0, 0, 0, 0.15);
    }

    .video-card video {
        width: 100%;
        height: auto;
        max-height: 200px;
        border-radius: 0.5rem;
        margin-bottom: 1rem;
    }

    .video-card h3 {
        font-size: 1.25rem;
        font-weight: 600;
        color: #1f2937;
        margin-bottom: 0.5rem;
    }

    .video-card p {
        font-size: 0.9rem;
        color: #4b5563;
        margin-bottom: 1rem;
    }


</style>

<div class="video-container">
    @if($videos && count($videos) > 0)
        @foreach($videos as $video)
            <div class="video-card">
                <h3>{{ $video->titre_video }}</h3>
                <p>{{ $video->description_video }}</p>
                <video controls>
                    <source src="{{ asset('assets/' .  $video->file_video) }}" type="video/mp4">
                    Votre navigateur ne supporte pas la lecture de cette vidéo.
                </video>
                <form action="{{ route('video.download', ['fileName' => $video->file_video]) }}" method="get">
                    <input type="submit" value="Télécharger" class="btn btn-primary">
                </form>
            </div>
        @endforeach
    @else
        <p>Aucune vidéo trouvée pour ce stand.</p>
    @endif
</div>
@endsection
