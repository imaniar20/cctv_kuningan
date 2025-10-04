<!DOCTYPE html>

<!-- =========================================================
* Sneat - Bootstrap 5 HTML Admin Template - Pro | v1.0.0
==============================================================

* Product Page: https://themeselection.com/products/sneat-bootstrap-html-admin-template/
* Created by: ThemeSelection
* License: You must have a valid license purchased in order to legally use the theme for your project.
* Copyright ThemeSelection (https://themeselection.com)

=========================================================
 -->
<!-- beautify ignore:start -->
<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../assets_2/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>ATCS KUNINGAN</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../assets_2/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="../assets_2/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="../assets_2/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="../assets_2/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="../assets_2/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="../assets_2/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="../assets_2/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="../assets_2/js/config.js"></script>
  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar layout-without-menu">
      <div class="layout-container">
        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->

          <nav
            class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
            id="layout-navbar"
          >
            <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
              <!-- Search -->
              <div class="navbar-nav align-items-center">
                <div class="nav-item d-flex align-items-center">
                  
                </div>
              </div>
              <!-- /Search -->

              <ul class="navbar-nav flex-row align-items-center ms-auto">
                <!-- User -->
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                  <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                      <img src="../assets_2/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" />
                    </div>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                      <a class="dropdown-item" href="#">
                        <div class="d-flex">
                          <div class="flex-shrink-0 me-3">
                            <div class="avatar avatar-online">
                              <img src="../assets_2/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" />
                            </div>
                          </div>
                          <div class="flex-grow-1">
                            <span class="fw-semibold d-block">CC</span>
                            <small class="text-muted">Admin</small>
                          </div>
                        </div>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <a class="dropdown-item" href="/logout">
                        <i class="bx bx-power-off me-2"></i>
                        <span class="align-middle">Log Out</span>
                      </a>
                    </li>
                  </ul>
                </li>
                <!--/ User -->
              </ul>
            </div>
          </nav>

          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <!-- Layout Demo -->
              <div class="layout-demo-wrapper">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <h6 class="mt-2">CCTV KABUPATEN KUNINGAN</h6>
                            </div>
                            <div class="col-6 text-end">
                                <a href="" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#tambahCctv"><i class="bx bx-plus-circle"></i> Tambah Cctv</a>
                            </div>
                        </div>
                        <hr>
                        <div class="text-nowrap">
                            <table class="table datatable display nowrap display nowrap">
                                <thead>
                                    <tr>
                                        <th style="width: 5%">#</th>
                                        <th>Nama</th>
                                        <th>Latitude</th>
                                        <th>Longitude</th>
                                        <th>Status</th>
                                        <th style="width: 10%">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border">
                                    @php
                                        $i = 1;
                                    @endphp
                                    @forelse ($cameras as $data)
                                        <tr data-slug="{{ $data->slug }}">
                                            <td class="small fw-semibold"><i class="fab fa-angular fa-lg text-danger me-3"></i>{{ $i++ }}</td>
                                            <td class="small fw-semibold">{{ $data->name }}</td>
                                            <td class="small fw-semibold">{{ $data->lat }}</td>
                                            <td class="small fw-semibold">{{ $data->lng }}</td>
                                            <td class="small fw-semibold camera-status"><span class="status-text">Checking...</span></td>
                                            <td>
                                                <ul class="list-unstyled users-list m-1 avatar-group d-flex align-items-center">
                                                    <a class="open-Edit-cctv" data-bs-toggle="modal" data-bs-target="#ubahCctv" data-id="{{ $data->id }}" data-name="{{ $data->name }}" data-rtsp="{{ $data->rtsp_url }}" data-lat="{{ $data->lat }}" data-lng="{{ $data->lng }}">
                                                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up me-3" style="background-color: #ffab00">
                                                            <i class="bx bx-edit-alt ms-1 mt-1" style="color: white;"></i>
                                                        </li>
                                                    </a>
                                                    <a class="open-Hapus-cctv" data-id="{{ $data->id }}">
                                                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" style="background-color: #ff0000">
                                                            <i class="bx bx-trash ms-1 mt-1" style="color: white;"></i>
                                                        </li>
                                                    </a>
                                                </ul>
                                            </td>
                                        </tr>
                                    @empty
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


              </div>
              <!--/ Layout Demo -->
            </div>
            <!-- / Content -->

            <!-- Footer -->
            {{-- <footer class="content-footer footer bg-footer-theme">
              <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                <div class="mb-2 mb-md-0">
                  ©
                  <script>
                    document.write(new Date().getFullYear());
                  </script>
                  , made with ❤️ by
                  <a href="https://themeselection.com" target="_blank" class="footer-link fw-bolder">ThemeSelection</a>
                </div>
                <div>
                  <a href="https://themeselection.com/license/" class="footer-link me-4" target="_blank">License</a>
                  <a href="https://themeselection.com/" target="_blank" class="footer-link me-4">More Themes</a>

                  <a
                    href="https://themeselection.com/demo/sneat-bootstrap-html-admin-template/documentation/"
                    target="_blank"
                    class="footer-link me-4"
                    >Documentation</a
                  >

                  <a
                    href="https://github.com/themeselection/sneat-html-admin-template-free/issues"
                    target="_blank"
                    class="footer-link me-4"
                    >Support</a
                  >
                </div>
              </div>
            </footer> --}}
            <!-- / Footer -->

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>
    </div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
function updateStatus() {
    $.get('/cameras/status', function(data) {
        data.forEach(cam => {
            let row = $(`tr[data-slug="${cam.slug}"]`);
            let el  = row.find(".status-text");

            el.text(cam.status);
            el.css("color", cam.status === "online" ? "green" : "red");
        });
    });
}

setInterval(updateStatus, 5000);
updateStatus();
</script>
<!-- Modal -->
{{-- Tambah Anggaran --}}
<div class="modal fade" id="tambahCctv" data-bs-backdrop="static" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form class="modal-content" method="POST" id="addAnggaran" action="{{ route('cctv.store') }}" enctype="multipart/form-data">
        @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="backDropModalTitle">Tambah Cctv</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 mb-3">
                        <label for="name" class="form-label">Nama Cctv</label>
                        <input id="name" name="name" class="form-control" placeholder="Masukan Nama Cctv" required>
                    </div>
                    <div class="col-12 mb-3">
                        <label for="rtsp" class="form-label">RTSP</label>
                        <input id="rtsp" name="rtsp" class="form-control" placeholder="Masukan RTSP" required>
                    </div>
                    <div class="col-12 mb-3">
                        <label for="lat" class="form-label">Latitude</label>
                        <input id="lat" name="lat" class="form-control" placeholder="Masukan Latitude" required>
                    </div>
                    <div class="col-12 mb-3">
                        <label for="lng" class="form-label">Longitude</label>
                        <input id="lng" name="lng" class="form-control" placeholder="Masukan Longitude" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    Batal
                </a>
                <button type="submit" class="btn btn-primary">Tambah</button>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="ubahCctv" data-bs-backdrop="static" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form class="modal-content" method="POST" id="editCctv" action="{{ route('cctv.update', 1) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
            <div class="modal-header">
                <h5 class="modal-title" id="backDropModalTitle">Ubah Cctv</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="id_cctv" name="id_cctv" class="form-control" placeholder="Masukan Nama Cctv" required>

                <div class="row">
                    <div class="col-12 mb-3">
                        <label for="edit_name" class="form-label">Nama Cctv</label>
                        <input id="edit_name" name="edit_name" class="form-control" placeholder="Masukan Nama Cctv" required>
                    </div>
                    <div class="col-12 mb-3">
                        <label for="edit_rtsp" class="form-label">RTSP</label>
                        <input id="edit_rtsp" name="edit_rtsp" class="form-control" placeholder="Masukan RTSP" required>
                    </div>
                    <div class="col-12 mb-3">
                        <label for="edit_lat" class="form-label">Latitude</label>
                        <input id="edit_lat" name="edit_lat" class="form-control" placeholder="Masukan Latitude" required>
                    </div>
                    <div class="col-12 mb-3">
                        <label for="edit_lng" class="form-label">Longitude</label>
                        <input id="edit_lng" name="edit_lng" class="form-control" placeholder="Masukan Longitude" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    Batal
                </a>
                <button type="submit" class="btn btn-warning">Ubah</button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).on("click", ".open-Edit-cctv", function () {
        var id = $(this).data('id');
        var name = $(this).data('name');
        var rtsp = $(this).data('rtsp');
        var lat = $(this).data('lat');
        var lng = $(this).data('lng');
        
        $(".modal-body #id_cctv").val(id);  
        $(".modal-body #edit_name").val( name );
        $(".modal-body #edit_rtsp").val( rtsp );
        $(".modal-body #edit_lat").val( lat );
        $(".modal-body #edit_lng").val( lng );
    });

    $(document).on("click", ".open-Hapus-cctv", function () {
        var id = $(this).data('id');

        Swal.fire({
            title: "Hapus Data Cctv?",
            text: "Anda tidak akan dapat mengembalikannya!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Hapus",
            cancelButtonText: "Batal",
            backdrop: true 
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: '{{ route("cctv.destroy", 1) }}',
                    type:"DELETE",
                    dataType: "json",
                    data:{
                        id:id,
                        _token:'{{ csrf_token() }}'
                    },
                    success:function(){
                        window.location.reload();
                    },
                }); 
            }
        });
    });
</script>

@if (session('success'))
    <script>
        Swal.fire({
            title: 'Success!',
            text: '{{ session('success') }}',
            icon: 'success',
            confirmButtonText: 'OK'
        });
    </script>
@endif

@if (session('error'))
    <script>
        Swal.fire({
            title: 'Error!',
            text: '{{ session('error') }}',
            icon: 'error',
            confirmButtonText: 'OK'
        });
    </script>
@endif

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="../assets_2/vendor/libs/jquery/jquery.js"></script>
    <script src="../assets_2/vendor/libs/popper/popper.js"></script>
    <script src="../assets_2/vendor/js/bootstrap.js"></script>
    <script src="../assets_2/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="../assets_2/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="../assets_2/js/main.js"></script>

    <!-- Page JS -->

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
  </body>
</html>
