@extends('layouts.app')
@section('Content')
    {{-- Custom Styles --}}
    <style>
        :root {
            --primary-color: #0d6efd;
            --warning-color: #ffc107;
            --success-color: #28a745;
            --danger-color: #dc3545;
            --dark-color: #212529;
            --light-bg: #f8f9fa;
        }

        /* FIXED: Hero Section Enhanced - Removed overlapping */
        .site-hero {
            position: relative;
            height: 100vh;
            min-height: 600px;
            background: linear-gradient(135deg, rgba(13, 110, 253, 0.9) 0%, rgba(255, 193, 7, 0.8) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            padding: 0;
        }

        .bg-blur {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            backdrop-filter: blur(3px);
            z-index: 1;
        }

        .site-hero-inner {
            position: relative;
            z-index: 2;
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 800;
            letter-spacing: -1px;
            margin-bottom: 1rem;
            text-shadow: 2px 4px 8px rgba(0, 0, 0, 0.3);
        }

        .hero-subtitle {
            font-size: 1.3rem;
            font-weight: 300;
            text-shadow: 1px 2px 4px rgba(0, 0, 0, 0.2);
        }

        .hero-divider {
            width: 100px;
            height: 4px;
            background: var(--warning-color);
            margin: 2rem auto;
            border-radius: 2px;
        }

        /* Mouse Scroll Animation */
        .mouse {
            position: absolute;
            bottom: 40px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 3;
        }

        .mouse-icon {
            width: 26px;
            height: 42px;
            border: 2px solid rgba(255, 255, 255, 0.8);
            border-radius: 13px;
            position: relative;
        }

        .mouse-wheel {
            width: 4px;
            height: 10px;
            background: rgba(255, 255, 255, 0.8);
            border-radius: 2px;
            position: absolute;
            top: 8px;
            left: 50%;
            transform: translateX(-50%);
            animation: scroll 2s infinite;
        }

        @keyframes scroll {

            0%,
            100% {
                opacity: 0;
                top: 8px;
            }

            50% {
                opacity: 1;
                top: 16px;
            }
        }

        /* FIXED: Action Section - Added clear separation */
        .section.bg-light {
            position: relative;
            z-index: 10;
            margin-top: -1px;
            /* Ensures no gap between sections */
            padding-top: 3rem;
            padding-bottom: 3rem;
        }

        .check-availabilty {
            background: linear-gradient(135deg, #ffffff 0%, #ffffff 100%);
            padding: 2rem;
            border-radius: 20px;
            margin-top: -50px;
            position: relative;
            z-index: 10;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        /* Action Buttons Enhanced */
        .btn-hover {
            transition: all 0.3s ease;
            border: none;
        }

        .btn-hover:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15) !important;
        }

        /* About Section Enhanced */
        .flip-card {
            background-color: transparent;
            width: 100%;
            height: 500px;
            perspective: 1000px;
        }

        .flip-card-inner {
            position: relative;
            width: 100%;
            height: 100%;
            text-align: center;
            transition: transform 0.8s;
            transform-style: preserve-3d;
        }

        .flip-card:hover .flip-card-inner {
            transform: rotateY(180deg);
        }

        .flip-card-front,
        .flip-card-back {
            position: absolute;
            width: 100%;
            height: 100%;
            -webkit-backface-visibility: hidden;
            backface-visibility: hidden;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.2);
        }

        .flip-card-back {
            transform: rotateY(180deg);
        }

        .flip-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .feature-badge {
            display: inline-block;
            background: var(--warning-color);
            color: var(--dark-color);
            padding: 0.5rem 1.5rem;
            border-radius: 50px;
            font-weight: 600;
            margin: 0.5rem;
            font-size: 0.9rem;
        }

        /* Map Section Enhanced */
        #map {
            height: 720px;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
            border: 4px solid white;
        }

        /* Custom Leaflet Popup */
        .custom-popup .leaflet-popup-content-wrapper {
            border-radius: 12px;
            padding: 0;
            overflow: hidden;
        }

        .popup-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, #0a58ca 100%);
            color: white;
            padding: 1rem;
            font-weight: 600;
        }

        .popup-body {
            padding: 1rem;
        }

        .popup-status {
            display: inline-flex;
            align-items: center;
            padding: 0.4rem 1rem;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            margin-top: 0.5rem;
        }

        .popup-status.online {
            background: rgba(40, 167, 69, 0.1);
            color: var(--success-color);
        }

        .popup-status.offline {
            background: rgba(220, 53, 69, 0.1);
            color: var(--danger-color);
        }

        /* CCTV Cards Enhanced */
        .cctv-scroll-wrapper {
            position: relative;
            padding: 2rem 0;
        }

        .cctv-scroll-container {
            display: flex;
            overflow-x: auto;
            scroll-behavior: smooth;
            gap: 2rem;
            padding: 1rem 0;
            scrollbar-width: thin;
            scrollbar-color: var(--warning-color) var(--light-bg);
        }

        .cctv-scroll-container::-webkit-scrollbar {
            height: 8px;
        }

        .cctv-scroll-container::-webkit-scrollbar-track {
            background: var(--light-bg);
            border-radius: 10px;
        }

        .cctv-scroll-container::-webkit-scrollbar-thumb {
            background: var(--warning-color);
            border-radius: 10px;
        }

        .cctv-scroll-item {
            min-width: 320px;
            flex-shrink: 0;
        }

        .cctv-card {
            border-radius: 16px;
            overflow: hidden;
            transition: all 0.3s ease;
            background: white;
        }

        .cctv-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15) !important;
        }

        .cctv-card .card-header {
            background: linear-gradient(135deg, var(--warning-color) 0%, #ffcd39 100%);
            border: none;
        }

        .cctv-card .card-body {
            position: relative;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            min-height: 130px;
        }

        .cctv-card .card-body::before {
            content: '';
            position: absolute;
            inset: 0;
            background: rgba(255, 255, 255, 0.7);
            z-index: 0;
        }

        .cctv-card .card-body > * {
            position: relative;
            z-index: 1;
        }

        .cctv-card .card-footer {
            padding: 1rem;
        }

        .status-indicator {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            display: inline-block;
            margin-right: 0.5rem;
            animation: pulse 2s infinite;
        }

        .status-indicator.online {
            background: var(--success-color);
        }

        .status-indicator.offline {
            background: var(--danger-color);
            animation: none;
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.5;
            }
        }

        /* Scroll Navigation Buttons */
        .scroll-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: white;
            border: 2px solid var(--warning-color);
            color: var(--warning-color);
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            z-index: 10;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .scroll-btn:hover {
            background: var(--warning-color);
            color: white;
            transform: translateY(-50%) scale(1.1);
        }

        .scroll-prev {
            left: -25px;
        }

        .scroll-next {
            right: -25px;
        }

        /* Statistics Cards */
        .stat-card {
            background: white;
            border-radius: 16px;
            padding: 2rem;
            text-align: center;
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            border-color: var(--warning-color);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            margin: 0 auto 1rem;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
        }

        /* FIXED: Modal Styles */
        .modal-backdrop {
            z-index: 1055;
        }

        .modal {
            z-index: 1060;
        }

        .modal-content {
            border: none;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2rem;
            }

            .hero-subtitle {
                font-size: 1rem;
            }

            .scroll-btn {
                display: none;
            }

            .check-availabilty {
                margin-top: -30px;
                padding: 1.5rem;
            }
        }

        /* Loading Animation */
        .loading-spinner {
            width: 40px;
            height: 40px;
            border: 4px solid rgba(255, 193, 7, 0.2);
            border-top-color: var(--warning-color);
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin: 2rem auto;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        /* Tambah di style section */
        #locationModal.modal {
            z-index: 99999;
        }

        #locationModal .modal-dialog {
            margin-top: 80px;
            /* Sesuaikan tinggi navbar */
            height: calc(100vh - 100px);
            /* Kurangi tinggi navbar */
        }

        .modal-backdrop {
            z-index: 99998;
        }

        .location-label {
            font-family: 'Syne', sans-serif;
            font-size: 1.2rem;
            font-weight: 700;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: #f5c518;
            margin: 40px 0 16px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .location-label::after {
            content: '';
            flex: 1;
            height: 1px;
            background: linear-gradient(to right, #333, transparent);
        }
    </style>

    {{-- Hero Section --}}
    <section class="site-hero overlay" id="section-home">
        <div class="bg-blur"></div>
        <div class="container">
            <div class="row site-hero-inner justify-content-center align-items-center">
                <div class="col-md-10 text-center" data-aos="fade-up">
                    <div class="hero-divider"></div>
                    <h1 class="hero-title text-white">Panon Kabupaten Kuningan</h1>
                    <p class="hero-subtitle text-white">Sistem Monitoring CCTV Terintegrasi untuk Keamanan dan Transparansi
                    </p>
                    <div class="hero-divider"></div>
                </div>
            </div>
        </div>

        <a class="mouse smoothscroll mb-5" href="#section-CCTV">
            <div class="mouse-icon">
                <span class="mouse-wheel"></span>
            </div>
        </a>
    </section>

    {{-- Action Section --}}
    <section class="section bg-light" id="section-CCTV">
        <div class="container">
            <div class="row check-availabilty">
                <div class="col-12 text-center mb-4" data-aos="fade-down">
                    <h4 class="fw-bold" style="font-family: 'Poppins', 'Segoe UI', Arial, sans-serif;">
                        Pantau kondisi keamanan wilayah Kabupaten Kuningan secara langsung dan transparan
                    </h4>
                </div>

                <div class="row g-3 justify-content-center align-items-center">
                    <div class="col-md-5 col-lg-4" data-aos="fade-right">
                        <a href="#section-peta" type="button"
                            class="btn btn-warning btn-outline-light btn-hover w-100 p-3 d-flex align-items-center justify-content-center shadow text-decoration-none">
                            <i class='bx bx-cctv bx-md me-3'></i>
                            <div class="text-start">
                                <div class="fw-bold">Peta CCTV</div>
                                <small class="opacity-75">Kuningan</small>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-5 col-lg-4" data-aos="fade-left">
                        <a href="#section-live" type="button"
                            class="btn btn-primary btn-outline-light btn-hover w-100 p-3 d-flex align-items-center justify-content-center shadow text-decoration-none">
                            <i class='bx bx-list-ul bx-md me-3'></i>
                            <div class="text-start">
                                <div class="fw-bold">List CCTV</div>
                                <small class="opacity-75">Kuningan</small>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- About Section --}}
    <section class="py-5 bg-light" id="section-about">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-md-12 col-lg-6 order-lg-2" data-aos="fade-left">
                    <div class="flip-card">
                        <div class="flip-card-inner">
                            <div class="flip-card-front">
                                <img src="{{ asset('assets/images/diskominfo.jpg') }}" alt="CCTV Monitoring">
                            </div>
                            <div class="flip-card-back">
                                <img src="{{ asset('assets/images/cctv.jpg') }}" alt="CCTV System">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 col-lg-6 order-lg-1" data-aos="fade-right">
                    <h2 class="display-6 fw-bold mb-4">
                        Tentang Panon
                        <span class="text-warning">Kabupaten Kuningan</span>
                    </h2>

                    <p class="lead mb-4">
                        Sistem pemantauan terintegrasi dengan teknologi canggih untuk keamanan maksimal
                    </p>

                    <div class="mb-4">
                        <span class="feature-badge">
                            <i class='bx bx-camera me-1'></i> {{ count($cameras) }} Kamera HD
                        </span>
                        <span class="feature-badge">
                            <i class='bx bx-wifi me-1'></i> Real-time Monitoring
                        </span>
                        <span class="feature-badge">
                            <i class='bx bx-shield-alt-2 me-1'></i> 24/7 Security
                        </span>
                        <span class="feature-badge">
                            <i class='bx bx-cloud me-1'></i> Cloud Storage
                        </span>
                    </div>

                    <p class="text-muted mb-4">
                        Dengan <strong class="text-warning">{{ count($cameras) }} kamera canggih</strong> yang tersebar di
                        lokasi strategis,
                        sistem Panon Kabupaten Kuningan memberikan akses langsung untuk memantau fasilitas publik
                        dan perkantoran secara <strong>real-time</strong>.
                    </p>

                    <div class="row g-3">
                        <div class="col-6">
                            <div class="d-flex align-items-center">
                                <i class='bx bx-check-circle text-success fs-4 me-2'></i>
                                <span>Kualitas HD</span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="d-flex align-items-center">
                                <i class='bx bx-check-circle text-success fs-4 me-2'></i>
                                <span>Night Vision</span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="d-flex align-items-center">
                                <i class='bx bx-check-circle text-success fs-4 me-2'></i>
                                <span>Motion Detection</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Map Section --}}
    <section class="section py-5" style="background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);" id="section-peta">
        <div class="container">
            <div class="row justify-content-center text-center mb-5">
                <div class="col-lg-8">
                    <h2 class="display-5 fw-bold mb-3" data-aos="fade-down">
                        <span class="text-dark">Peta Sebaran</span>
                        <span class="text-warning">Kamera CCTV</span>
                    </h2>
                    <p class="lead text-muted" data-aos="fade-up">
                        <i class='bx bx-map-pin me-2'></i>
                        Pemantauan real-time melalui jaringan CCTV terintegrasi
                    </p>
                </div>
            </div>

            <div class="row">
                <div class="col-12" data-aos="zoom-in">
                    <div id="map"></div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-12">
                    <div class="d-flex justify-content-center gap-4 flex-wrap">
                        <div class="d-flex align-items-center">
                            <span class="status-indicator online me-2"></span>
                            <span class="fw-semibold">Online</span>
                        </div>
                        <div class="d-flex align-items-center">
                            <span class="status-indicator offline me-2"></span>
                            <span class="fw-semibold">Offline</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- CCTV List Section --}}
    <section class="py-5 bg-light" id="section-live">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-lg-8 text-center">
                    <h2 class="display-5 fw-bold mb-3" data-aos="fade-down">
                        Jaringan <span class="text-warning">{{ count($cameras) }} CCTV</span> Kuningan
                    </h2>
                    <p class="lead text-muted" data-aos="fade-up">
                        Monitor seluruh lokasi strategis secara real-time
                    </p>
                </div>
            </div>
            <div class="row g-3">
                @foreach ($location as $item)
                    @if ($item->camera_count > 0)
                        <div class="col-12">
                            <div class="location-label">
                                <i class='bx bx-map-pin'></i>
                                {{ $item->nama }}
                            </div>
                        </div>
                        <div class="cctv-scroll-container" id="camera-status-list">
                            @foreach ($item->camera as $data)
                                <div class="col-6 col-md-3">
                                    <div class="cctv-scroll-item camera-status" data-slug="{{ $data->slug }}">
                                        <div class="card cctv-card h-100 border-0 shadow">
                                            <div class="card-header py-3">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <h5 class="mb-0 fw-bold">
                                                        <i class='bx bx-cctv me-2'></i>
                                                        {{ $data->name }}
                                                    </h5>
                                                    <span class="badge bg-dark">CCTV</span>
                                                </div>
                                            </div>
                                            <div class="card-body" style="
                                                        height: 160px;
                                                        background-image: url('{{ $data->foto && file_exists(storage_path('app/public/' . $data->foto)) ? asset('storage/' . $data->foto) : asset('assets_2/image/users/default.png') }}');
                                                        background-size: cover;
                                                        background-position: center;
                                                    ">
                                                <div class="mb-3">
                                                    <h6 class="text-primary mb-2">
                                                        <i class='bx bx-map-pin me-1'></i>
                                                        {{ $data->name }}
                                                    </h6>
                                                    <p class="text-muted small mb-0">
                                                        <i class='bx bx-time-five me-1'></i>
                                                        Pemantauan 24/7
                                                    </p>
                                                </div>
                
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="status-text d-flex align-items-center">
                                                        <span class="status-indicator online me-2"></span>
                                                        <span class="fw-semibold">Checking...</span>
                                                    </div>
                                                    <i class='bx bx-signal-5 text-success fs-5'></i>
                                                </div>
                                            </div>
                                            <div class="card-footer bg-transparent border-0 pt-0 mt-3">
                                                <button class="btn btn-primary btn-sm w-100 fw-semibold"
                                                    onclick="showCameraModal({{ $data->id }})">
                                                    <i class='bx bx-play-circle me-1'></i>
                                                    Live View
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                @endforeach
            </div>
            
            {{-- <div class="cctv-scroll-wrapper" data-aos="fade-up">
                <div class="cctv-scroll-container" id="camera-status-list">
                    @foreach ($cameras as $data)
                        <div class="cctv-scroll-item camera-status" data-slug="{{ $data->slug }}">
                            <div class="card cctv-card h-100 border-0 shadow">
                                <div class="card-header py-3">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h5 class="mb-0 fw-bold">
                                            <i class='bx bx-cctv me-2'></i>
                                            {{ $data->name }}
                                        </h5>
                                        <span class="badge bg-dark">CCTV</span>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <h6 class="text-primary mb-2">
                                            <i class='bx bx-map-pin me-1'></i>
                                            {{ $data->name }}
                                        </h6>
                                        <p class="text-muted small mb-0">
                                            <i class='bx bx-time-five me-1'></i>
                                            Pemantauan 24/7
                                        </p>
                                    </div>

                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="status-text d-flex align-items-center">
                                            <span class="status-indicator online me-2"></span>
                                            <span class="fw-semibold">Checking...</span>
                                        </div>
                                        <i class='bx bx-signal-5 text-success fs-5'></i>
                                    </div>
                                </div>
                                <div class="card-footer bg-transparent border-0 pt-0">
                                    <button class="btn btn-primary btn-sm w-100 fw-semibold"
                                        onclick="showCameraModal({{ $data->id }})">
                                        <i class='bx bx-play-circle me-1'></i>
                                        Live View
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="scroll-navigation d-none d-lg-block">
                    <button class="scroll-btn scroll-prev" onclick="scrollHorizontal(-300)">
                        <i class='bx bx-chevron-left bx-md'></i>
                    </button>
                    <button class="scroll-btn scroll-next" onclick="scrollHorizontal(300)">
                        <i class='bx bx-chevron-right bx-md'></i>
                    </button>
                </div>
            </div> --}}

            {{-- Scroll Indicator --}}
            <div class="row mt-4">
                <div class="col-12 text-center">
                    <small class="text-muted d-flex align-items-center justify-content-center">
                        <i class='bx bx-chevron-left me-2'></i>
                        Geser untuk melihat lebih banyak CCTV
                        <i class='bx bx-chevron-right ms-2'></i>
                    </small>
                </div>
            </div>

            {{-- Statistics Section --}}
            <div class="row mt-5 pt-5 g-4" data-aos="fade-up">
                <div class="col-md-4">
                    <div class="stat-card">
                        <div class="stat-icon bg-warning bg-opacity-10 text-warning">
                            <i class='bx bx-camera'></i>
                        </div>
                        <div class="display-4 fw-bold text-warning mb-2">{{ count($cameras) }}</div>
                        <div class="text-muted fw-semibold">Total CCTV</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card">
                        <div class="stat-icon bg-success bg-opacity-10 text-success">
                            <i class='bx bx-wifi'></i>
                        </div>
                        <div class="display-4 fw-bold text-success mb-2">
                            <span id="online-count">0</span>
                        </div>
                        <div class="text-muted fw-semibold">Kamera Online</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card">
                        <div class="stat-icon bg-primary bg-opacity-10 text-primary">
                            <i class='bx bx-time-five'></i>
                        </div>
                        <div class="display-4 fw-bold text-primary mb-2">24/7</div>
                        <div class="text-muted fw-semibold">Monitoring Aktif</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Modal for Camera Details --}}
    <div class="modal fade" id="locationModal" data-bs-backdrop="static" tabindex="-1"
        aria-labelledby="locationModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 20px;">
                <div class="modal-header bg-primary text-white" style="border-radius: 20px 20px 0 0;">
                    <h5 class="modal-title fw-bold" id="locationModalLabel">
                        <i class='bx bx-video me-2'></i>
                        Detail Kamera CCTV
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div id="locationDetails">
                        <div class="loading-spinner"></div>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class='bx bx-x me-1'></i>
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- Scripts --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

    <script>
        // Horizontal scroll function
        function scrollHorizontal(offset) {
            const container = document.getElementById('camera-status-list');
            container.scrollBy({
                left: offset,
                behavior: 'smooth'
            });
        }

        // Camera status update
        function updateStatus() {
            $.get('/dashboard/cameras/status', function(res) {
                res.cameras.forEach(cam => {
                    let el = $(`.camera-status[data-slug="${cam.slug}"]`);
                    let statusText = el.find('.status-text span:last-child');
                    let statusIndicator = el.find('.status-indicator');

                    statusText.text(cam.status === 'online' ? 'Online' : 'Offline');

                    if (cam.status === 'online') {
                        statusIndicator.removeClass('offline').addClass('online');
                    } else {
                        statusIndicator.removeClass('online').addClass('offline');
                    }

                    if (cameraMarkers[cam.slug]) {
                        // Cari data camera lengkap untuk dapat name dan id
                        const cameraData = camerasData.find(c => c.slug === cam.slug);
                        if (cameraData) {
                            updateMarkerPopup(cam.slug, cameraData.name, cameraData.id, cam.status);
                        }
                    }
                });

                $("#online-count").text(res.online);

                // Update map markers
                if (window.cameraMarkers) {
                    res.cameras.forEach(cam => {
                        if (window.cameraMarkers[cam.slug]) {
                            updateMarkerIcon(cam.slug, cam.status);
                        }
                    });
                }
            });
        }

        function updateMarkerPopup(slug, name, id, status) {
            const marker = cameraMarkers[slug];
            if (!marker) return;

            const statusBadge = status === 'online' ?
                '<span class="popup-status online"><i class="bx bx-wifi me-1"></i>Online</span>' :
                '<span class="popup-status offline"><i class="bx bx-wifi-off me-1"></i>Offline</span>';

            // Buat popup content baru
            const popupContent = `
                <div class="custom-popup">
                    <div class="popup-header">
                        <i class='bx bx-cctv me-2'></i>CCTV ${name}
                    </div>
                    <div class="popup-body">
                        <p class="mb-2"><strong>Lokasi:</strong> ${name}</p>
                        <p class="mb-2"><strong>Status:</strong></p>
                        ${statusBadge}
                        <div class="mt-3">
                            <button class="btn btn-primary btn-sm w-100" onclick="showCameraModal(${id})">
                                <i class='bx bx-play-circle me-1'></i>Live View
                            </button>
                        </div>
                    </div>
                </div>
            `;

            // Unbind popup lama, bind popup baru
            marker.unbindPopup();
            marker.bindPopup(popupContent, {
                className: 'custom-popup',
                maxWidth: 250
            });

            // Update icon juga
            marker.setIcon(getCameraIcon(status));
        }

        // Initialize map with custom camera icons
        let map;
        let cameraMarkers = {};

        function initMap() {
            // Check if map is already initialized
            if (map !== undefined && map !== null) {
                map.remove(); // Remove existing map instance
            }

            // Clear the map container
            document.getElementById('map').innerHTML = '';

            // Initialize map centered on Kuningan
            map = L.map('map', {
                scrollWheelZoom: 'center'
            }).setView([-6.9761, 108.4831], 13);

            // Add tile layer
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
                maxZoom: 19
            }).addTo(map);

            // Add cameras to map
            let hasMarkers = false;
            @foreach ($cameras as $camera)
                @php
                    // Handle both direct properties and location relationship
                    $lat = $camera->latitude ?? ($camera->lat ?? ($camera->location->latitude ?? null));
                    $lng = $camera->longitude ?? ($camera->lng ?? ($camera->location->longitude ?? null));
                @endphp
                @if ($lat && $lng)
                    addCameraMarker(
                        {{ $lat }},
                        {{ $lng }},
                        "{{ $camera->name }}",
                        "{{ $camera->slug }}",
                        {{ $camera->id }},
                        'checking'
                    );
                    hasMarkers = true;
                @endif
            @endforeach

            // If we added markers, fit the map to show all of them
            if (hasMarkers && Object.keys(cameraMarkers).length > 0) {
                const group = new L.featureGroup(Object.values(cameraMarkers));
                map.fitBounds(group.getBounds().pad(0.1));
            }

            // Force map to refresh its size
            setTimeout(function() {
                map.invalidateSize();
            }, 100);
        }

        function getCameraIcon(status) {
            const color = status === 'online' ? '#28a745' : (status === 'offline' ? '#dc3545' : '#6c757d');

            return L.divIcon({
                className: 'custom-camera-marker',
                html: `
            <div style="position: relative; width: 60px; height: 60px;">
                <svg width="60" height="60" viewBox="0 0 60 60" style="filter: drop-shadow(0 4px 8px rgba(0,0,0,0.4));">
                    <!-- Camera body -->
                    <rect x="10" y="20" width="40" height="26" rx="4" fill="${color}" stroke="white" stroke-width="3"/>
                    <!-- Lens -->
                    <circle cx="30" cy="33" r="8" fill="white" opacity="0.9"/>
                    <circle cx="30" cy="33" r="5" fill="${color}"/>
                    <!-- Mount -->
                    <rect x="26" y="12" width="8" height="10" fill="${color}" stroke="white" stroke-width="2"/>
                    <circle cx="30" cy="12" r="5" fill="${color}" stroke="white" stroke-width="3"/>
                    <!-- Status indicator -->
                    <circle cx="50" cy="15" r="6" fill="${color}" stroke="white" stroke-width="3">
                        ${status === 'online' ? '<animate attributeName="opacity" values="1;0.3;1" dur="2s" repeatCount="indefinite"/>' : ''}
                    </circle>
                    <!-- Additional detail - lens reflection -->
                    <circle cx="28" cy="31" r="2" fill="white" opacity="0.6"/>
                </svg>
            </div>
        `,
                iconSize: [60, 60],
                iconAnchor: [30, 60],
                popupAnchor: [0, -60]
            });
        }

        function addCameraMarker(lat, lng, name, slug, id, status = 'checking') {
            const marker = L.marker([lat, lng], {
                icon: getCameraIcon(status)
            }).addTo(map);

            const statusBadge = status === 'online' ?
                '<span class="popup-status online"><i class="bx bx-wifi me-1"></i>Online</span>' :
                status === 'offline' ?
                '<span class="popup-status offline"><i class="bx bx-wifi-off me-1"></i>Offline</span>' :
                '<span class="popup-status"><i class="bx bx-loader-alt me-1"></i>Checking...</span>';

            marker.bindPopup(`
                <div class="custom-popup">
                    <div class="popup-header">
                        <i class='bx bx-cctv me-2'></i>CCTV ${name}
                    </div>
                    <div class="popup-body">
                        <p class="mb-2"><strong>Lokasi:</strong> ${name}</p>
                        <p class="mb-2"><strong>Status:</strong></p>
                        ${statusBadge}
                        <div class="mt-3">
                            <button class="btn btn-primary btn-sm w-100" onclick="showCameraModal(${id})">
                                <i class='bx bx-play-circle me-1'></i>Live View
                            </button>
                        </div>
                    </div>
                </div>
            `, {
                className: 'custom-popup',
                maxWidth: 250
            });

            cameraMarkers[slug] = marker;
        }

        function updateMarkerIcon(slug, status) {
            if (cameraMarkers[slug]) {
                cameraMarkers[slug].setIcon(getCameraIcon(status));
            }
        }

        // Initialize on document ready
        $(document).ready(function() {
            // Fix smooth scroll offset for sticky headers
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    const targetId = this.getAttribute('href');
                    if (targetId === '#') return;

                    const targetElement = document.querySelector(targetId);
                    if (targetElement) {
                        window.scrollTo({
                            top: targetElement.offsetTop - 80,
                            behavior: 'smooth'
                        });
                    }
                });
            });

            // Initialize map only once
            if (typeof initMap === 'function') {
                initMap();
            }

            // Start status updates
            updateStatus();
            setInterval(updateStatus, 5000);
        });

        // Make markers globally accessible
        window.cameraMarkers = cameraMarkers;

        // FIXED: Ensure modal closes properly
        document.addEventListener('DOMContentLoaded', function() {
            const locationModal = document.getElementById('locationModal');
            if (locationModal) {
                locationModal.addEventListener('hidden.bs.modal', function() {
                    $('#locationDetails').empty();
                });
            }
        });
    </script>
@endsection
