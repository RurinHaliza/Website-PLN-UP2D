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

        <h2>Data Monitor GI Jawa Timur</h2>
        <div id='map'></div>

        <div class="row mt-3">

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h3>Analytical</h3>
                    </div>
                    <div class="card-body">
                        <ul>
                            <li>Beban Tertinggi Jatim Hari Ini</li>
                            <ul>
                                <li>MW: </li>
                                <li>Tanggal</li>
                                <li>Pukul</li>
                            </ul>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
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
                                        <th>Wilayah</th>
                                        <th>Persentase siang</th>
                                        <th>Persentase malam</th>
                                        <th>Persentase Tertinggi</th>
                                        <th>Action</th>
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
                                            <td>{{ $trafo->wilayah }}</td>
                                            <td>{{ $trafo->persensiang }} %</td>
                                            <td>{{ $trafo->persenmalam }} %</td>
                                            <td>{{ $trafo->persentertinggi }} %</td>
                                            <td>
                                                <a href="" class="btn btn-primary">Detail</a>
                                            </td>
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
                                        <th>Wilayah</th>
                                        <th>Persentase siang</th>
                                        <th>Persentase malam</th>
                                        <th>Persentase Tertinggi</th>
                                        <th>Action</th>
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
                                            <td>{{ $trafo->wilayah }}</td>
                                            <td>{{ $trafo->persensiang }} %</td>
                                            <td>{{ $trafo->persenmalam }} %</td>
                                            <td>{{ $trafo->persentertinggi }} %</td>
                                            <td>
                                                <a href="" class="btn btn-primary">Detail</a>
                                            </td>
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

        L.tileLayer('https://mt0.google.com/vt/lyrs=s&x={x}&y={y}&z={z}', {
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
