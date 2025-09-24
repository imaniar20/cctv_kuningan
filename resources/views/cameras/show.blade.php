@extends('layouts.app')

@section('content')
<div class="container py-4">
    <a href="{{ route('cameras.index') }}" class="btn btn-secondary mb-3">← Kembali</a>

    <h2 class="mb-3">{{ $camera->name }}</h2>

    <div class="ratio ratio-16x9">
        <video id="live" controls autoplay style="width:100%; height:auto;">
            <source src="{{ asset("stream/{$camera->slug}/playlist.m3u8") }}" type="application/x-mpegURL">
        </video>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/hls.js@latest"></script>
<script>
if (Hls.isSupported()) {
    var hls = new Hls();
    hls.loadSource("{{ asset("stream/{$camera->slug}/playlist.m3u8") }}");
    hls.attachMedia(document.getElementById('live'));
}
</script>
@endpush
