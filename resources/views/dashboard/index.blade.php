@extends('layouts.app')
@section('Content')
<div id="map" class="rounded-lg border border-gray-200 mb-6" style="height: 720px;"></div>

<!-- Modal untuk Detail Lokasi -->
<div class="modal fade" id="locationModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="locationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="locationModalLabel">Detail Lokasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="locationDetails">
                    <!-- Detail lokasi akan dimuat di sini -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

@endsection
