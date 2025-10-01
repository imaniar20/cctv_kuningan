<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<link rel="stylesheet" href="https://unpkg.com/leaflet-draw@1.0.4/dist/leaflet.draw.css" />
<style>
    .text-shadow {
        text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
    }
    .btn-hover {
        transition: all 0.3s ease;
        border: 2px solid transparent;
    }
    .btn-hover:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    }
    .btn-outline-light.btn-hover:hover {
        background-color: rgba(255,255,255,0.1);
        border-color: #fff;
    }
    .btn-warning.btn-hover:hover {
        background-color: #ffc107;
        border-color: #ffc107;
        filter: brightness(1.1);
    }

    @media (min-width: 1200px) {
        .modal-xl {
            max-width: 1140px; /* sama seperti container-xl */
        }
    }
    h1 {
        color: #ffffff; /* hitam tapi nggak terlalu tajam */
        font-family: 'Poppins', 'Segoe UI', Arial, sans-serif;
        font-weight: 700;
        font-size: 4rem;
        margin-bottom: 0.5rem;
    }
    .site-hero {
        position: relative;
        overflow: hidden;
        height: 100vh; /* tinggi section */
    }

    .site-hero .bg-blur {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: url('assets/images/bg.jpg');
        background-size: cover;
        background-position: center;
        filter: blur(6px);
        z-index: 0;
    }

    .site-hero .container {
        position: relative;
        z-index: 1; /* konten tetap di atas background blur */
        color: white;
    }
    .dropify-wrapper .dropify-message p {
        font-size: 14px; /* Ubah ukuran teks */
        color: #6c757d; /* Sesuaikan warna jika diperlukan */
        text-align: center; /* Pastikan teks rata tengah */
    }

    .swal2-container {
        z-index: 9999 !important; /* Atur z-index lebih tinggi dari modal */
    }

    .border-right {
        border-right: 1px solid #d9dee3; /* Atur warna dan ketebalan garis */
        height: 100%; /* Pastikan border mencakup tinggi kontainer */
    }

    .bootstrap-select .btn {
        border: 1px solid #ced4da; /* Gaya border seperti elemen form-control */
        border-radius: 0.375rem;   /* Border radius seperti Bootstrap */
        background-color: #fff;   /* Pastikan warna latar belakang putih */
        box-shadow: none;         /* Hapus shadow bawaan */
    }

    .bootstrap-select .dropdown-menu {
        max-height: 200px;  /* Ganti sesuai kebutuhan */
        overflow-y: auto;   /* Menambahkan scrollbar vertikal jika opsi lebih banyak */
    }

    /* Padding hanya untuk tabel dengan kelas 'custom-table' */
    .collapse-table td {
        padding: 1rem; /* Sama dengan p-3 */
    }

    .datatable-indikator th {
        text-align: center !important;
        vertical-align: middle;
    }

    .table-laporan th {
        text-align: center !important;
        vertical-align: middle;
        color: white !important;
    }

    .table-laporan td {
        padding: 0.5rem !important;
    }

    .table-urusan th {
        text-align: center !important;
        vertical-align: middle;
        color: white !important;
    }

    .table-subUrusan th {
        color:#566a7f !important;
    }

    /* Custom styling for popover */
    .popover {
        background-color: black !important;
        color: white;
        border-radius: 10px;
        max-width: 1000px !important; /* Sesuaikan dengan kebutuhan */
        width: 100%; /* Bisa diubah sesuai keinginan */
    }
    .popover-header {
        background-color: black !important;
        color: white;
        border-bottom: 1px solid gray;
    }
    .popover-body {
        background-color: black !important;
        color: white;
    }
    hr {
        margin-top: 0.25rem !important;
        margin-bottom: 0.25rem !important;
    }

    .table-auto {
        table-layout: auto;
        width: 100%;
    }
    .table-auto th,
    .table-auto td {
        white-space: nowrap; /* Mencegah teks wrapping */
    }

  </style>

  <style>

  .scroll-navigation {
    position: absolute;
    top: 50%;
    left: 0;
    right: 0;
    transform: translateY(-50%);
    pointer-events: none;
    z-index: 2;
}

.scroll-btn {
    position: absolute;
    background: #ffc107;
    border: none;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #000;
    font-size: 1.2rem;
    pointer-events: all;
    transition: all 0.3s ease;
}

.scroll-btn:hover {
    background: #e0a800;
    transform: scale(1.1);
}

.scroll-prev { left: -20px; }
.scroll-next { right: -20px; }
</style>

<style>
.cctv-scroll-wrapper {
    position: relative;
    padding: 0 10px;
}

.cctv-scroll-container {
    display: flex;
    overflow-x: auto;
    gap: 1.5rem;
    padding: 1rem 0.5rem;
    scroll-behavior: smooth;
    -webkit-overflow-scrolling: touch;
    scrollbar-width: thin;
    scrollbar-color: #ffc107 #f8f9fa;
}

.cctv-scroll-container::-webkit-scrollbar {
    height: 8px;
}

.cctv-scroll-container::-webkit-scrollbar-track {
    background: #f8f9fa;
    border-radius: 10px;
}

.cctv-scroll-container::-webkit-scrollbar-thumb {
    background: #ffc107;
    border-radius: 10px;
}

.cctv-scroll-item {
    flex: 0 0 auto;
    width: 300px; /* Fixed width for consistent cards */
}

.cctv-card {
    transition: all 0.3s ease;
    border: 1px solid #e9ecef;
    min-height: 280px;
}

.cctv-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.15) !important;
}

/* Hide scrollbar on mobile */
@media (max-width: 768px) {
    .cctv-scroll-container {
        scrollbar-width: none;
    }
    
    .cctv-scroll-container::-webkit-scrollbar {
        display: none;
    }
    
    .cctv-scroll-item {
        width: 280px; /* Slightly smaller on mobile */
    }
}
</style>

<style>
.flip-card {
    perspective: 1000px;
    height: 400px;
}

.flip-card-inner {
    position: relative;
    width: 100%;
    height: 100%;
    transition: transform 0.8s;
    transform-style: preserve-3d;
}

.flip-card:hover .flip-card-inner {
    transform: rotateY(180deg);
}

.flip-card-front, .flip-card-back {
    position: absolute;
    width: 100%;
    height: 100%;
    backface-visibility: hidden;
    border-radius: 10px;
    overflow: hidden;
}

.flip-card-back {
    transform: rotateY(180deg);
    position: relative;
}

.flip-card-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
}
</style>

<script>
function scrollHorizontal(distance) {
    const container = document.querySelector('.cctv-scroll-container');
    container.scrollBy({ left: distance, behavior: 'smooth' });
}
</script>