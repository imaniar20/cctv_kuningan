{{-- <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script> --}}
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script> --}}


<script src="{{ asset('assets/js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery-migrate-3.0.1.min.js') }}"></script>
<script src="{{ asset('assets/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.stellar.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.fancybox.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.easing.1.3.js') }}"></script>



<script src="{{ asset('assets/js/aos.js') }}"></script>

<script src="{{ asset('assets/js/bootstrap-datepicker.js') }}"></script> 
<script src="{{ asset('assets/js/jquery.timepicker.min.js') }}"></script> 

<script src="{{ asset('assets/js/main.js') }}"></script>


<script src="{{ asset('assets/js/vendor/modernizr-3.5.0.min.js') }}"></script>
<script src="{{ asset('assets/js/vendor/jquery-1.12.4.min.js') }}"></script>
{{-- <script src="{{ asset('assets/js/popper.min.js+bootstrap.min.js.pagespeed.jc.1THY_pwCW8.js') }}"></script> --}}

{{-- <script src="{{ asset('assets/js/owl.carousel.min.js+slick.min.js.pagespeed.jc.YqDU5urJVF.js') }}"></script> --}}
{{-- <script src="{{ asset('assets/js/jquery.slicknav.min.js+wow.min.js+jquery.magnific-popup.js+jquery.nice-select.min.js+jquery.counterup.min.js+waypoints.min.js.pagespeed.jc.ZO59WbtP6X.js') }}"></script><script>eval(mod_pagespeed_PHkKEhM9y_);</script> --}}

{{-- <script src="{{ asset('assets/js/contact.js+jquery.form.js+jquery.validate.min.js+mail-script.js+jquery.ajaxchimp.min.js+plugins.js+main.js.pagespeed.jc.iZz6M_SFgf.js') }}"></script>
<script src="{{ asset('/assets/js/gijgo.min.js') }}"></script> --}}

<script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
<script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-23581568-13');
</script>
<script defer src="" integrity="sha512-gV/bogrUTVP2N3IzTDKzgP0Js1gg4fbwtYB6ftgLbKQu/V8yH2+lrKCfKHelh4SO3DPzKj4/glTO+tNJGDnb0A==" data-cf-beacon='{"rayId":"6b379c5c2f1e4649","token":"cd0b4b3a733644fc843ef0b185f98241","version":"2021.11.0","si":100}' crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
<script src="https://cdn.jsdelivr.net/npm/hls.js@latest"></script>


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
                <h6 class="font-weight-bold text-primary mb-3">${cameraData.name}</h6>
                <div class="row">
                    <div class="col-md-6 mb-2">
                        <strong>Kode:</strong> ${cameraData.slug}
                    </div>
                    <div class="col-md-6 mb-2">
                        <strong>Koordinat:</strong><br>
                        Lat: ${parseFloat(cameraData.lat).toFixed(6)}<br>
                        Lng: ${parseFloat(cameraData.lng).toFixed(6)}
                    </div>
                    <div class="col-12">
                        <div class="embed-responsive embed-responsive-16by9">
                            <video id="${videoId}" class="embed-responsive-item" controls autoplay></video>
                        </div>
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
