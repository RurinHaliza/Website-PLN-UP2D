@extends('layouts.app')

@section('title', 'Dashboard')

@push('style')
<style>
    .text-center {
        text-align: center;
    }

    #map {
        width: '100%';
        height: 700px;
    }
</style>
<link rel='stylesheet' href='https://unpkg.com/leaflet@1.8.0/dist/leaflet.css' crossorigin='' />
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Dashboard Validator Opsis</h1>
            </div>
        </section>

        <div class="row mt-3">
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Jumlah Penyulang
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $countPenyulang }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Jumlah GI
                                </div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $countGI }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-industry-list fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Jumlah Trafo
                                </div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $countTrafo }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-industry-list fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Jumlah mVA

                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $mva }} Ampere</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <h2>Data Monitor GI Jawa Timur</h2>
        <div id='map'></div>

        <div class="row mt-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Monitor Trafo > 80 % : {{ $CountTrafoSiang80 }} Trafo</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="beban_ktt" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Gardu Induk</th>
                                        <th>No Trafo</th>
                                        <th>Wilayah</th>
                                        <th>Persentase siang</th>
                                        <th>Persentase malam</th>
                                        <th>Persentase Tertinggi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp

                                    @foreach ($TrafoSiang80 as $trafo)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $trafo->gardu_induk }}</td>
                                            <td>{{ $trafo->no_trafo }}</td>
                                            <td>{{ $trafo->wilayah }}</td>
                                            <td>{{ $trafo->persensiang }} %</td>
                                            <td>{{ $trafo->persenmalam }} %</td>
                                            <td>{{ $trafo->persentertinggi }} %</td>
                   
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Monitor Trafo < 30 % : {{ $CountTrafo30 }} Trafo</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="trafo30" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Gardu Induk</th>
                                        <th>No Trafo</th>
                                        <th>Wilayah</th>
                                        <th>Persentase siang</th>
                                        <th>Persentase malam</th>
                                        <th>Persentase Tertinggi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp

                                    @foreach ($Trafo30 as $trafo)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $trafo->gardu_induk }}</td>
                                            <td>{{ $trafo->no_trafo }}</td>
                                            <td>{{ $trafo->wilayah }}</td>
                                            <td>{{ $trafo->persensiang }} %</td>
                                            <td>{{ $trafo->persenmalam }} %</td>
                                            <td>{{ $trafo->persentertinggi }} %</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('scripts')
<script src='https://unpkg.com/leaflet@1.8.0/dist/leaflet.js' crossorigin=''></script>
<script src='https://unpkg.com/leaflet-control-geocoder@2.4.0/dist/Control.Geocoder.js'></script>

<script>
    $("#beban_ktt").dataTable({
        "pageLength": 5,
        "columnDefs": [{
            "sortable": false,
            "targets": [6, 3],
        }],
    });
</script>

<script>
    $("#trafo30").dataTable({
        "pageLength": 5,
        "columnDefs": [{
            "sortable": false,
            "targets": [6, 3],
        }],
    });
</script>


<script>
    let map, markers = [];
    /* ----------------------------- Initialize Map ----------------------------- */
    function initMap() {
        map = L.map('map', {
            center: {
                lat: -7.5360639,
                lng: 112.2384017,
            },
            zoom: 10
        });

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap'
        }).addTo(map);

        map.on('click', mapClicked);
        initMarkers();
    }
    initMap();

    function initMarkers() {
        const initialMarkers = @json($initialMarkers);

        for (let index = 0; index < initialMarkers.length; index++) {

            const data = initialMarkers[index];
            const marker = generateMarker(data, index);

            var url = '{{ route("detail.gimaps.opsis", ":id") }}'.replace(':id', data.note.id);

            marker.addTo(map).bindPopup(
                "<b>ID GI: </b>" + data.note.id +
                "<br><b>Nama: </b>" + data.note.nama +
                "<br><b>Pengelola: </b>" + data.note.pengelola +
                "<br><b>Jumlah Penyulang: </b>" + data.note.jumlah_penyulang + 
                "<br><b>Jumlah Trafo: </b>" + data.note.jumlah_trafo +
                '<br><br><a href="' + url + '" class="btn btn-primary">Detail Data</a>' 
            );
            map.panTo(data.position);
            markers.push(marker)

        }
    }

    function generateMarker(data, index) {
        return L.marker(data.position, {
                draggable: data.draggable
            })
            .on('click', (event) => markerClicked(event, index))
            .on('dragend', (event) => markerDragEnd(event, index));
    }

    /* ------------------------- Handle Map Click Event ------------------------- */
    function mapClicked($event) {
        console.log(map);
        console.log($event.latlng.lat, $event.latlng.lng);
    }

    /* ------------------------ Handle Marker Click Event ----------------------- */
    function markerClicked($event, index) {
        console.log(map);
        console.log($event.latlng.lat, $event.latlng.lng);
    }

    /* ----------------------- Handle Marker DragEnd Event ---------------------- */
    function markerDragEnd($event, index) {
        console.log(map);
        console.log($event.target.getLatLng());
    }
</script>
@endpush
