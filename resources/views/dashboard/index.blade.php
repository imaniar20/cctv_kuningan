@extends('layouts.app')
@section('Content')

<section class="site-hero overlay" data-stellar-background-ratio="0.5" id="section-home">
    <!-- background blur -->
    <div class="bg-blur"></div>

    <div class="container">
        <div class="row site-hero-inner justify-content-center align-items-center">
            <div class="col-md-10 text-center" data-aos="fade-up">
                <hr>
                <h1 class="text-shadow text-white">Panon Kabupaten Kuningan</h1>
                <h2 class="text-shadow text-white">Selamat datang di Website resmi Monitoring CCTV Kabupaten Kuningan</h2>
                <hr>
            </div>
        </div>
    </div>
    
    <a class="mouse smoothscroll" href="#next" >
        <div class="mouse-icon">  
            <span class="mouse-wheel"></span>
        </div>
    </a>
</section>

<section class="section bg-light pb-0"  id="section-cekAcara">
    <div class="container">
        <div class="row check-availabilty" id="next">
        <div class="block-32 text-center" data-aos="fade-down" data-aos-offset="-200">
            
            <label class="font-weight-bold text-black mb-2"><h4 style="font-family: 'Poppins', 'Segoe UI', Arial, sans-serif;">Pantau kondisi keamanan wilayah Kabupaten Kuningan secara langsung dan transparan</h4></label>
            <div class="row justify-content-center justify-content-lg-between align-items-center">
                <!-- List CCTV - Kiri (Desktop), Tengah (Mobile) -->
                <div class="col-md-5 col-lg-6 mb-3 mb-lg-0 d-flex justify-content-center justify-content-lg-end">
                    <a href="#section-peta" type="button" class="btn btn-warning btn-outline-light btn-hover btn-block p-3 d-flex align-items-center justify-content-center shadow" style="min-width: 200px;">
                        <i class='bx bx-cctv bx-md me-3'></i>
                        <div class="text-start">
                            <div class="fw-bold">Peta CCTV</div>
                            <small class="opacity-75">Kuningan</small>
                        </div>
                    </a>
                </div>
                
                <!-- Peta CCTV - Kanan (Desktop), Tengah (Mobile) -->
                <div class="col-md-5 col-lg-6 mb-3 mb-lg-0 d-flex justify-content-center justify-content-lg-start">
                    <a href="#section-live" type="button" class="btn btn-primary btn-outline-light btn-hover btn-block p-3 d-flex align-items-center justify-content-center shadow" style="min-width: 200px;">
                        <i class='bx bx-list-ul bx-md me-3'></i>
                        <div class="text-start">
                            <div class="fw-bold">List CCTV</div>
                            <small class="opacity-75">Kuningan</small>
                        </div>
                    </a>
                </div>
            </div>
            {{-- <div class="row">
                <div class="col-md-6 mb-3 mb-lg-0 col-lg-4">
                    <label class="font-weight-bold text-black">Mulai Acara</label>
                    <div class="field-icon-wrap">
                        <div class="icon"><span class="icon-calendar"></span></div>
                        <input type="date" name="cek_in1" id="cek_in1" class="form-control">
                        <p id="errCekIn" class="text-danger"></p> 
                    </div>
                </div>
                <div class="col-md-6 mb-3 mb-lg-0 col-lg-4">
                    <label class="font-weight-bold text-black">Akhir Acara</label>
                    <div class="field-icon-wrap">
                        <div class="icon"><span class="icon-calendar"></span></div>
                        <input type="date" name="cek_out1" id="cek_out1" class="form-control">
                        <p id="errCekOut" class="text-danger"></p> 
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 align-self-end">
                    <button type="submit" class="btn btn-primary btn-block text-white" title="Cek Ketersediaan">Cek Ketersediaan</button> 
                </div>
            </div> --}}
        </div>
        </div>
    </div>
</section>

<section class="py-5 bg-light" id="section-about">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-12 col-lg-7 ml-auto order-lg-2 position-relative mb-5" data-aos="fade-up">
                <div class="flip-card">
                    <div class="flip-card-inner">
                        <!-- Depan -->
                        <div class="flip-card-front">
                            <img src="{{ asset('assets/images/diskominfo.jpg') }}" alt="CCTV Depan" class="img-fluid rounded">
                        </div>
                        <!-- Belakang -->
                        <div class="flip-card-back">
                            <img src="{{ asset('assets/images/cctv.jpg') }}" alt="CCTV Belakang" class="img-fluid rounded">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-5 order-lg-1" data-aos="fade-down">
            <h2 class="heading mb-4 text-shadow" data-aos="fade-down">Tentang Panon<span class="text-warning text-shadow"> Kabupaten Kuningan</span></h2>
                <p class="mb-7">
                    <span class="text-warning fw-bold">CCTV Kuningan</span> menawarkan sistem pemantauan terintegrasi dengan fitur lengkap:
                </p>
                <p class="mb-7 fs-5">
                    Dengan <strong class="text-warning">13 kamera canggih</strong>, CCTV Kuningan memberikan akses langsung untuk memantau fasilitas publik dan perkantoran secara <strong>real-time</strong>. Kecepatan akses dan transparansi informasi menjadi komitmen kami dalam menciptakan lingkungan yang lebih aman.
                </p>
                {{-- <p><a href="https://youtu.be/mDRuTZTXslc"  data-fancybox class="btn btn-primary text-white py-2 mr-3 text-uppercase letter-spacing-1">Watch the video</a></p> --}}
            </div>
        
        </div>
    </div>
</section>
<hr>
<section class="section bg-image overlay" style="background-image: url({{ asset('assets/images/cc.jpeg') }})" id="section-peta">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div>
                <h2 class="heading mb-4 text-shadow" data-aos="fade-down"><span class="text-white">Peta</span> <span class="text-warning text-shadow">Kamera</span></h2>

                <p class="text-white" data-aos="fade-up" data-aos-delay="100">
                    <i class='bx bx-map-pin me-2'></i>Pemantauan <span class="text-warning">real-time</span> melalui jaringan CCTV terintegrasi di Kabupaten Kuningan
                </p>
            </div>
        </div>
        <div class="p-5">
            <div id="map" class="rounded-lg border border-gray-200 mb-6 p-5" data-aos="fade-up" style="height: 720px;">
        </div>
    </div>
</section>
<hr>
<!-- Section List CCTV -->
<section class="py-5 bg-light" id="section-live">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-lg-8 text-center">
                <h2 class="display-5 fw-bold mb-3" data-aos="fade-down">Jaringan <span class="text-warning">{{ count($cameras) }} CCTV</span> Kuningan</h2>
                <p class="lead text-muted" data-aos="fade-up">Monitor seluruh lokasi strategis secara real-time</p>
            </div>
        </div>

        <!-- Horizontal Scroll Container -->
        <div class="cctv-scroll-wrapper">
            <div class="cctv-scroll-container" id="camera-status-list" data-aos="fade-up">
                @foreach($cameras as $data)
                    <div class="cctv-scroll-item camera-status" data-slug="{{ $data->slug }}">
                        <div class="card cctv-card h-100 border-0 shadow-sm">
                            <div class="card-header bg-warning text-dark py-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0 fw-bold">CCTV {{ $data->name }}</h5>
                                    <i class='bx bx-cctv fs-4'></i>
                                </div>
                            </div>
                            <div class="card-body">
                                {{-- <h6 class="text-primary mb-2">Lokasi Strategis {{ $data->location->nama }}</h6> --}}
                                <h6 class="text-primary mb-2">Lokasi Strategis {{ $data->name }}</h6>
                                <p class="text-muted small mb-3">Pemantauan area publik dan lalu lintas</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="status-text">Checking...</span>
                                    <small class="text-muted">24/7 Active</small>
                                </div>
                            </div>
                            <div class="card-footer bg-transparent border-0">
                                <button class="btn btn-outline-primary btn-sm w-100" onclick="showCameraModal({{ $data->id }})">
                                    <i class='bx bx-play-circle me-1'></i>Live View
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="scroll-navigation d-none d-lg-block">
                <button class="scroll-btn scroll-prev" onclick="scrollHorizontal(-300)">
                    <i class='bx bx-chevron-left'></i>
                </button>
                <button class="scroll-btn scroll-next" onclick="scrollHorizontal(300)">
                    <i class='bx bx-chevron-right'></i>
                </button>
            </div>
        </div>

        <!-- Scroll Indicators -->
        <div class="row mt-4">
            <div class="col-12 text-center">
                <small class="text-muted">
                    <i class='bx bx-chevron-left bx-xs me-1'></i>
                    Scroll untuk melihat lebih banyak CCTV
                    <i class='bx bx-chevron-right bx-xs ms-1'></i>
                </small>
            </div>
        </div>

        <!-- Statistik Section -->
        <div class="row mt-5 pt-5" data-aos="fade-down">
            <div class="col-12">
                <div class="bg-white rounded-3 p-4 shadow-sm">
                    <div class="row text-center">
                        <div class="col-md-4 mb-3">
                            <div class="display-6 fw-bold text-warning">{{ count($cameras) }}</div>
                            <div class="text-muted">Total CCTV</div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="display-6 fw-bold text-success"><span id="online-count">0</span></div>
                            <div class="text-muted">Online</div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="display-6 fw-bold text-primary">24/7</div>
                            <div class="text-muted">Operasional</div>
                        </div>
                        {{-- <div class="col-md-3 mb-3">
                            <div class="display-6 fw-bold text-info">100%</div>
                            <div class="text-muted">Coverage Area</div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal untuk Detail Lokasi -->
<div class="modal fade" style="z-index: 999999" id="locationModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="locationModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="locationModalLabel">Detail Lokasi</h5>
        {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button> --}}
      </div>
      <div class="modal-body">
        <div id="locationDetails">
          <!-- Detail lokasi akan dimuat di sini -->
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
function updateStatus() {
    $.get('/dashboard/cameras/status', function(res) {
        // update per kamera
        res.cameras.forEach(cam => {
            let el = $(`.camera-status[data-slug="${cam.slug}"] .status-text`);
            el.text(cam.status);
            el.css("color", cam.status === "online" ? "green" : "red");
        });

        // update counter
        $("#online-count").text(res.online);
    });
}

setInterval(updateStatus, 5000);
updateStatus();
</script>
@endsection
