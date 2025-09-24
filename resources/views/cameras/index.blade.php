@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h1 class="mb-4">Daftar Kamera CCTV</h1>
    <div class="row">
        @foreach($cameras as $cam)
            <div class="col-md-4 mb-3">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h5 class="card-title">{{ $cam->name }}</h5>
                        <a href="{{ route('cameras.show', $cam) }}" class="btn btn-primary btn-sm">Lihat Stream</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
