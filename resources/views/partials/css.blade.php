<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<link rel="stylesheet" href="https://unpkg.com/leaflet-draw@1.0.4/dist/leaflet.draw.css" />
<style>
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