@extends('layouts.app')

@section('title', 'Detail Data')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.min.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('library/datatables/media/css/jquery.dataTables.min.css') }}"> --}}
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Detail Data GI : {{ $getDataGI->Nama_GI }}</h1>
            </div>
        </section>
        <a href="{{ url()->previous() }}" class="btn btn-danger">Kembali</a>
        <div class="card mt-3">
            <div class="card-header">
                <h5 class="m-0 font-weight-bold text-primary">Detail Info</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive mt-3">
                    <table id="detail" class="table table-hover" style="width:100%">
                        <tbody>
                            <tr>
                                <td><strong>ID_FGI : </strong></td>
                                @if ($getDataGI->ID_FGI == null)
                                    <td><u><strong>Belum Diisi</strong></u></td>
                                @else
                                    <td>{{ $getDataGI->ID_FGI }}</td>
                                @endif

                                <td><strong>Nama : </strong></td>
                                @if ($getDataGI->Nama_GI == null)
                                    <td><u><strong>Belum Diisi</strong></u></td>
                                @else
                                    <td>{{ $getDataGI->Nama_GI }}</td>
                                @endif
                            </tr>

                            <tr>
                                <td><strong>Nama singkatan : </strong></td>
                                @if ($getDataGI->NAMA_SINGKATAN == null)
                                    <td><u><strong>Belum Diisi</strong></u></td>
                                @else
                                    <td>{{ $getDataGI->NAMA_SINGKATAN }}</td>
                                @endif

                                <td><strong>KD Pemilik : </strong></td>
                                @if ($getDataGI->KD_Pemilik == null)
                                    <td><u><strong>Belum Diisi</strong></u></td>
                                @else
                                    <td>{{ $getDataGI->KD_Pemilik }}</td>
                                @endif
                            </tr>

                            <tr>
                                <td><strong>KD Pengelola : </strong></td>
                                @if ($getDataGI->KD_Pengelola == null)
                                    <td><u><strong>Belum Diisi</strong></u></td>
                                @else
                                    <td>{{ $getDataGI->KD_Pengelola }}</td>
                                @endif

                                <td><strong>Tingkat Resiko : </strong></td>
                                @if ($getDataGI->tingkat_resiko == null)
                                    <td><u><strong>Belum Diisi</strong></u></td>
                                @else
                                    <td>{{ $getDataGI->tingkat_resiko }}</td>
                                @endif
                            </tr>


                            <tr>
                                <td><strong>Koordinat X : </strong></td>
                                @if ($getDataGI->x == null)
                                    <td><u><strong>Belum Diisi</strong></u></td>
                                @else
                                    <td>{{ $getDataGI->x }}</td>
                                @endif

                                <td><strong>Kordinat Y : </strong></td>
                                @if ($getDataGI->y == null)
                                    <td><u><strong>Belum Diisi</strong></u></td>
                                @else
                                    <td>{{ $getDataGI->y }}</td>
                                @endif
                            </tr>

                            <tr>
                                <td><strong>Jumlah penyulang: </strong></td>
                                @if ($jumlahpenyulangGI == null)
                                    <td><u><strong>Tidak diketahui</strong></u></td>
                                @else
                                    <td>{{ $jumlahpenyulangGI }} Buah</td>
                                @endif

                                <td><strong>Jumlah Trafo : </strong></td>
                                @if ($jumlahTrafoGI == null)
                                    <td><u><strong>0</strong></u></td>
                                @else
                                    <td>{{ $jumlahTrafoGI }} Trafo</td>
                                @endif
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="card mt-3">
                    <div class="card-header">
                        <h5 class="m-0 font-weight-bold text-primary">Tabel Status Trafo</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="table-1" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Gardu Induk</th>
                                        <th>Wilayah</th>
                                        <th>No Trafo</th>
                                        <th>Beban Tertinggi</th>
                                        <th>Persentase Tertinggi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp

                                    @foreach ($datatrafo as $trafo)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $trafo->gardu_induk }}</td>
                                            <td>{{ $trafo->wilayah }}</td>
                                            <td>{{ $trafo->no_trafo }}</td>
                                            <td>{{ $trafo->bebantertinggi }} mW</td>
                                            <td>{{ $trafo->persentertinggi }} %</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card mt-3">
                    <div class="card-header">
                        <h5 class="m-0 font-weight-bold text-primary">Grafik</h5>
                    </div>
                    <div class="card-body">
                        <div class="card-body">
                            <div style="width: 100%; height:300px; margin: auto;">
                                <canvas id="barChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="card mt-3">
            <div class="card-header">
                <h5 class="m-0 font-weight-bold text-primary">Info Beban</h5>
            </div>
            <div class="card-body">

            </div>

        </div>

    </div>



@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var ctx = document.getElementById('barChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json($notrafograph),
                datasets: [{
                        label: 'Data Trafo (dalam mW)', // Name the series
                        data: @json($bebantertinggigraph), // Specify the data values array
                        fill: false,
                        borderColor: '#ffd000', // Add custom color border (Line)
                        backgroundColor: '#ffd000', // Add custom color background (Points and Fill)
                        borderWidth: 3 // Specify bar border width
                    },
                ]
            },
            options: {
                responsive: true, // Instruct chart js to respond nicely.
                maintainAspectRatio: false, // Add to prevent default behaviour of full-width/height
            }
        });
    </script>

    <script>
        $("#trafodata").dataTable({
            "columnDefs": [{
                "sortable": false,
                "targets": [6, 3],
            }],
        });
    </script>
    <script>
        $("#table-1").dataTable({
            "columnDefs": [{
                "sortable": false,
                "targets": [2, 3]
            }]
        });
    </script>
@endpush
