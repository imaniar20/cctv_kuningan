@extends('layouts.app')
@section('Content')

<section class="site-hero overlay" data-stellar-background-ratio="0.5" id="section-home">
    <!-- background blur -->
    <div class="bg-blur"></div>

    <div class="container">
        <div class="row site-hero-inner justify-content-center align-items-center">
            <div class="col-md-10 text-center" data-aos="fade-up">
                <hr>
                <h1>ATCS Kabupaten Kuningan</h1>
                <h2 style="color: #c6c6c6;">Selamat datang di Website resmi ATCS Kabupaten Kuningan</h2>
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

{{-- <section class="section bg-light pb-0"  id="section-cekAcara">
    <div class="container">
        <div class="row check-availabilty" id="next">
        <div class="block-32" data-aos="fade-up" data-aos-offset="-200">
            <form action="#" >
            <label class="font-weight-bold text-black"><h2>Cek tanggal acara anda, Apakah sudah ter Reservasi ?</h2></label>
            <label class="font-weight-bold text-black"></label>
            <div class="row">
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
            </div>
        </div>
        </div>
    </div>
</section> --}}

<section class="py-5 bg-light" id="section-about">
    <div class="container">
        <div class="row align-items-center">
        <div class="col-md-12 col-lg-7 ml-auto order-lg-2 position-relative mb-5" data-aos="fade-up">
            <img src="{{ asset('assets/img/logo/kuningan.png') }}" alt="Image" class="img-fluid rounded">
        </div>
        <div class="col-md-12 col-lg-4 order-lg-1" data-aos="fade-down">
        <h2 class="heading mb-4">Tentang ATCS</h2>
            
            
            <p class="mb-7">
                ATCS Kuningan
            </p>
            {{-- <p><a href="https://youtu.be/mDRuTZTXslc"  data-fancybox class="btn btn-primary text-white py-2 mr-3 text-uppercase letter-spacing-1">Watch the video</a></p> --}}
        </div>
        
        </div>
    </div>
</section>
<hr>
<section class="section bg-light" id="section-peta">
    <div class="container">
        <div class="row justify-content-center text-center mb-5">
            <div>
                <h2 class="heading" data-aos="fade-down">Peta Kamera</h2>
                <p class="" data-aos="fade-up" data-aos-delay="100">Titik lokasi cctv Kabupaten Kuningan</p>
            </div>
        </div>
        <div id="map" class="rounded-lg border border-gray-200 mb-6" style="height: 720px;">
    </div>
</section>


<!-- Modal untuk Detail Lokasi -->
<div class="modal fade" id="locationModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="locationModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="locationModalLabel">Detail Lokasi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
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


@endsection
