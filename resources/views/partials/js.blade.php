<!-- Core JS -->
<!-- build:js assets/vendor/js/core.js -->
<script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
<script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>

<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Dropify JS -->
{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}

<script src="{{ asset('assets/vendor/js/menu.js') }}"></script>
<!-- endbuild -->

<!-- Vendors JS -->
{{-- <script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<!-- Main JS -->
<script src="{{ asset('assets/js/main.js') }}"></script>

<!-- Page JS -->
<script src="{{ asset('assets/js/dashboards-analytics.js') }}"></script>
<script src="{{ asset('assets/js/ui-popover.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta3/js/bootstrap-select.min.js"></script>

<!-- Dropify JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>

{{-- datatable --}}
<script src="https://cdn.datatables.net/2.2.1/js/dataTables.js"></script>

<!-- JS Select2 -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/hls.js@latest"></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const selects = document.querySelectorAll('.select2');
        selects.forEach(select => $(select).select2());
    });
    
    $(document).ready(function() {
        $('.dropify').dropify();
    });

    $(document).ready(function() {
        $('.datatable').each(function() {
            if (!$.fn.DataTable.isDataTable(this)) {
                new DataTable(this);
            }
        });

        $('.datatable-indikator').each(function() {
            if (!$.fn.DataTable.isDataTable(this)) {
                new DataTable(this, {
                    ordering: false // Menonaktifkan sorting di seluruh tabel
                });
            }
        });
    });

    $(document).ready(function() {
        $('.number_input').each(function() {
            var input = $(this); // Mendapatkan elemen input saat ini

            input.on('input', function () {
                var number = input.val().replace(/,/g, ''); // Hapus koma
                if (!number) return; // Jika kosong, abaikan

                var n = !isFinite(+number) ? 0 : +number;
                var decimals = 0; // Jumlah desimal
                var sep = ','; // Pemisah ribuan
                var dec = '.'; // Tanda desimal
                var s = '';

                // Fungsi untuk membulatkan angka
                var toFixedFix = function (n, prec) {
                    var k = Math.pow(10, prec);
                    return '' + Math.round(n * k) / k;
                };

                // Proses format angka
                s = (decimals ? toFixedFix(n, decimals) : '' + Math.round(n)).split('.');
                if (s[0].length > 3) {
                    s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
                }
                if ((s[1] || '').length < decimals) {
                    s[1] = s[1] || '';
                    s[1] += new Array(decimals - s[1].length + 1).join('0');
                }

                // Update nilai ke input
                input.val(s.join(dec));
            });
        });
    });
</script>

@if ($errors->any())
    <script>
        Swal.fire({
            title: 'Error!',
            text: '{{ $errors->first() }}', // Menampilkan error pertama
            icon: 'error',
            confirmButtonText: 'OK'
        });
    </script>
@endif

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

<script>
    function confirmDelete(event) {
        event.preventDefault();  // Mencegah form mengirimkan data sebelum konfirmasi
    
        // Menampilkan SweetAlert konfirmasi
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data yang dihapus tidak dapat dipulihkan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal',
        }).then((result) => {
            if (result.isConfirmed) {
                // Jika konfirmasi diterima, kirimkan form untuk menghapus
                event.target.closest('form').submit();
            }
        });
    }
</script>

<script>
    currentMap = L.map('map').setView([-6.97583, 108.6], 12);

    const osmLayer = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors',
        name: 'OpenStreetMap'
    });

    const satelliteLayer = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
        attribution: '© Esri, Maxar, Earthstar Geographics, and the GIS User Community',
        name: 'Satellite'
    });

    const hybridLayer = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
        attribution: '© Esri, Maxar, Earthstar Geographics, and the GIS User Community',
        name: 'Hybrid'
    });

    const labelsLayer = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/Reference/World_Boundaries_and_Places/MapServer/tile/{z}/{y}/{x}', {
        attribution: '© Esri',
        name: 'Labels'
    });

    osmLayer.addTo(currentMap);

    const baseLayers = {
        "🛰️ Satelit": satelliteLayer,
        "🗺️ Peta Jalan": osmLayer,
        "🌍 Hybrid": L.layerGroup([satelliteLayer, labelsLayer])
    };

    L.control.layers(baseLayers).addTo(currentMap);

    drawnItems = new L.FeatureGroup();
    currentMap.addLayer(drawnItems);

    drawControl = new L.Control.Draw({
        position: 'topright',
        draw: {
            polygon: {
                allowIntersection: false,
                drawError: {
                    color: '#e1e100',
                    message: '<strong>Error:</strong> Polygon tidak boleh berpotongan!'
                },
                shapeOptions: {
                    color: '#3B82F6',
                    fillOpacity: 0.3
                }
            },
            polyline: false,
            rectangle: false,
            circle: false,
            marker: false,
            circlemarker: false
        },
        edit: {
            featureGroup: drawnItems,
            remove: true
        }
    });

    // Event handlers for drawing
    currentMap.on(L.Draw.Event.CREATED, function (e) {
        const layer = e.layer;
        tempPolygon = layer;
        
        // Show assignment modal
        populatePolygonKelompokSelect();
        document.getElementById('polygonAssignModal').classList.remove('hidden');
    });

    currentMap.on(L.Draw.Event.EDITED, function (e) {
        const layers = e.layers;
        layers.eachLayer(function (layer) {
            // Update polygon data if needed
            updatePolygonData(layer);
        });
        updateMapStats();
    });

    currentMap.on(L.Draw.Event.DELETED, function (e) {
        const layers = e.layers;
        layers.eachLayer(function (layer) {
            // Remove from mapPolygons array
            mapPolygons = mapPolygons.filter(p => p.leafletId !== layer._leaflet_id);
        });
        updateMapStats();
    });

    const customIcon = L.icon({
        iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-blue.png',
        shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
        iconSize: [25, 41],
        iconAnchor: [12, 41],
        popupAnchor: [1, -34],
        shadowSize: [41, 41]
    });

    // Fungsi untuk menambah marker dengan data Camera
    function addCameraMarker(cameraData) {
        const marker = L.marker([parseFloat(cameraData.lat), parseFloat(cameraData.lng)], { 
            icon: customIcon 
        })
        .addTo(currentMap)
        // .on('click', function(e) {
        //     showCameraModal(cameraData);
        // });
        
        // Tambahkan popup
        marker.bindPopup(`
            <div class="text-center">
                <strong>${cameraData.name}</strong><br>
                <small>${cameraData.slug}</small><br>
                <button class="btn btn-sm btn-primary mt-1" onclick="showCameraModal(${cameraData.id})">
                    Lihat Detail
                </button>
            </div>
        `);
        
        return marker;
    }

    // Fungsi untuk menampilkan modal berdasarkan ID
    function showCameraModal(cameraId) {
        // Cari data camera berdasarkan ID
        const cameraData = camerasData.find(camera => camera.id === cameraId);
        
        if (!cameraData) {
            console.error('Camera data not found for ID:', cameraId);
            return;
        }

        // bikin ID unik buat video biar gak bentrok
        const videoId = `live-${cameraData.slug}`;

        const modalContent = `
            <div class="camera-info">
                <h6 class="fw-bold text-primary">${cameraData.name}</h6>
                <div class="row">
                    <div class="col-12 mb-2">
                        <strong>Kode:</strong> ${cameraData.slug}
                    </div>
                    <div class="col-12 mb-2">
                        <strong>Koordinat:</strong><br>
                        Lat: ${parseFloat(cameraData.lat).toFixed(6)}<br>
                        Lng: ${parseFloat(cameraData.lng).toFixed(6)}
                    </div>
                    <div class="ratio ratio-16x9">
                        <video id="${videoId}" controls autoplay style="width:100%; height:auto;"></video>
                    </div>
                </div>
            </div>
        `;

        // masukin konten modal
        document.getElementById('locationDetails').innerHTML = modalContent;

        // setelah masuk DOM baru setup HLS
        const video = document.getElementById(videoId);
        const streamUrl = "{{ asset('stream') }}/" + cameraData.slug + "/playlist.m3u8";

        if (Hls.isSupported()) {
            const hls = new Hls();
            hls.loadSource(streamUrl);
            hls.attachMedia(video);
        } else if (video.canPlayType('application/vnd.apple.mpegurl')) {
            // fallback buat Safari/iOS
            video.src = streamUrl;
        }

        // tampilkan modal
        const modal = new bootstrap.Modal(document.getElementById('locationModal'));
        modal.show();
    }
    
    // Data cameras dari Laravel
    const camerasData = @json($cameras);

    // Tambahkan semua markers setelah peta siap
    currentMap.whenReady(function() {
        // Loop melalui setiap camera dan tambahkan marker
        camerasData.forEach(camera => {
            addCameraMarker(camera);
        });
        
        // Optional: Fit bounds untuk menampilkan semua marker
        if (camerasData.length > 0) {
            const group = new L.featureGroup(
                camerasData.map(camera => 
                    L.marker([parseFloat(camera.lat), parseFloat(camera.lng)])
                )
            );
            currentMap.fitBounds(group.getBounds().pad(0.1));
        }
    });
</script>
