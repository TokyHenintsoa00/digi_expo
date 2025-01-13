@extends('parent.parentHome')
@section('contenueVideoSection')
<style>
    .video-container {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 20px;
    }
    .video-card {
        background: #fff;
        border: 1px solid #ccc;
        border-radius: 10px;
        padding: 10px;
        text-align: center;
    }
    .video-card video {
        width: 100%;
        height: auto;
        border-radius: 10px;
    }
</style>

<div class="video-container">
    @if($videos && count($videos) > 0)
        @foreach($videos as $video)
            <div class="video-card">
                <h3>Titre:{{ $video->titre_video }}</h3>
                <p>Description:{{ $video->description_video }}</p>
                <video controls>
                    <source src="{{ asset('assets/' .  $video->file_video) }}" type="video/mp4">
                    Votre navigateur ne supporte pas la lecture de cette vidéo.
                </video>
                <form action="{{ route('video.download', ['fileName' => $video->file_video]) }}" method="get">
                    <input type="submit" value="Telecharger" class="btn btn-primary">
                </form>
            </div>
        @endforeach
    @else
        <p>Aucune vidéo trouvée pour ce stand.</p>
    @endif
</div>
@endsection
