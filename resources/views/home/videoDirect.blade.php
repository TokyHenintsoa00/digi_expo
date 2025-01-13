@extends('parent.parentHome')

@section('videoDirectSection')
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Ajouter ici le lien de la vidéo de audioConference</h5>
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('storeVideo') }}" method="POST">
                        @csrf
                        <div class="mb-3 d-flex">
                            <label for="videoUrl" class="form-label me-3">Lien de la vidéo</label>
                            <input type="url" class="form-control me-3" id="videoUrl" name="videoUrl" required style="width: 70%;" placeholder="https://www.youtube.com/..., https://www.twitch.tv/..., https://www.instagram.com/..., https://www.facebook.com/...">
                            <input type="submit" value="Valider" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>

            @if(session('videoUrl'))
            <div class="mt-4">
                <h5 class="fw-semibold">Vidéo en direct</h5>
                <div class="ratio ratio-16x9">
                    @php
                        $videoUrl = session('videoUrl');
                        $iframeSrc = '';

                        if (strpos($videoUrl, 'votre-serveur.com') !== false) {
                            $iframeSrc = $videoUrl; // Utilise directement le lien de votre serveur pour la vidéo
                        }

                          // Check for Zoom
                          if (strpos($videoUrl, 'zoom.us') !== false) {
                            $meetingId = basename(parse_url($videoUrl, PHP_URL_PATH));
                            $iframeSrc = "https://zoom.us/wc/join/{$meetingId}";
                        }

                        // Check for Twitch
                        if (strpos($videoUrl, 'twitch.tv') !== false) {
                            $path = parse_url($videoUrl, PHP_URL_PATH);
                            $channel = trim($path, '/');
                            $iframeSrc = "https://player.twitch.tv/?channel={$channel}&parent=" . request()->getHost();
                        }

                        // // Check for Facebook or fb.watch
                        // Check for Facebook or fb.watch
                        elseif (strpos($videoUrl, 'facebook.com') !== false || strpos($videoUrl, 'fb.watch') !== false) {
                            if (strpos($videoUrl, 'fb.watch') !== false) {
                                $encodedUrl = urlencode($videoUrl);
                                $iframeSrc = "https://www.facebook.com/plugins/video.php?href={$encodedUrl}&show_text=false&width=500";
                            } else {
                                $errorMessage = "Veuillez fournir un lien de vidéo valide depuis Facebook Watch.";
                            }
                        }





                        // Check for Instagram
                        elseif (strpos($videoUrl, 'instagram.com') !== false) {
                            $iframeSrc = "{$videoUrl}embed";
                        }

                        // Check for YouTube (including /live/ URLs)
                        elseif (strpos($videoUrl, 'youtube.com') !== false || strpos($videoUrl, 'youtu.be') !== false) {
                            // Handle youtu.be links
                            if (strpos($videoUrl, 'youtu.be') !== false) {
                                $videoId = substr(parse_url($videoUrl, PHP_URL_PATH), 1);
                            } else {
                                // Handle normal YouTube or /live/ URL
                                if (strpos($videoUrl, '/live/') !== false) {
                                    $videoId = basename(parse_url($videoUrl, PHP_URL_PATH));
                                } else {
                                    parse_str(parse_url($videoUrl, PHP_URL_QUERY), $queryParams);
                                    $videoId = $queryParams['v'] ?? null; // Use null if 'v' is not set
                                }
                            }

                            // Check if a valid YouTube video ID was found
                            if ($videoId) {
                                $iframeSrc = "https://www.youtube.com/embed/{$videoId}?autoplay=1&mute=1&enablejsapi=1";
                            }
                        }

                        // Default case
                        else {
                            $iframeSrc = $videoUrl;
                        }
                    @endphp

                    @if ($iframeSrc)
                    <iframe src="{{ $iframeSrc }}" width="100%" height="500px" frameborder="0" allowfullscreen></iframe>
                    @else
                    <p>{{ $errorMessage }}</p>
                    @endif
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
