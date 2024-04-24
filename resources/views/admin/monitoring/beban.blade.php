@extends('layouts.app')

@section('title', 'Beban Bulanan')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.min.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Highlight Kondisi Sistem</h1>
            </div>
        </section>
        <a href="{{ url()->previous() }}" class="btn btn-danger mb-4">Kembali</a>
        <a href="{{ route('detailbeban') }}" class="btn btn-primary mb-4">Detail Beban</a>


        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div style="width: 100%; height:170px; margin: auto;">
                            <canvas id="chartTahun"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div style="width: 100%; height:170px; margin: auto;">
                            <canvas id="chartBulan"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div style="width: 100%; height:170px; margin: auto;">
                            <canvas id="chartHari"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header"
                        style="background: linear-gradient(to bottom, rgb(58, 94, 255), rgb(99, 182, 255) 100%) !important; ">
                        <h4 style="color:white">Beban Jatim Tertinggi Tahun ini</h4>
                    </div>
                    <div class="card-body">
                        <ul>
                            <li>MW: {{ $maxValueYear }}</li>
                            <li>Tanggal : {{ $maxColumnYear }}</li>
                            <li>Pukul : {{ $maxDateYear }}</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header"
                        style="background: linear-gradient(to bottom, rgb(58, 94, 255), rgb(99, 182, 255) 100%) !important; ">
                        <h4 style="color:white">Beban Jatim Tertinggi Bulan ini</h4>
                    </div>
                    <div class="card-body">
                        <ul>
                            <li>MW: {{ $maxValueMonth }}</li>
                            <li>Tanggal : {{ $maxColumnMonth }}</li>
                            <li>Pukul : {{ $maxDateMonth }}</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header"
                        style="background: linear-gradient(to bottom, rgb(58, 94, 255), rgb(99, 182, 255) 100%) !important; ">
                        <h4 style="color:white">Beban Jatim Tertinggi Hari ini</h4>
                    </div>
                    <div class="card-body">
                        <ul>
                            <li>MW: {{ $maxValueT }}</li>
                            <li>Tanggal : {{ $selectedDate }} </li>
                            <li>Pukul : {{ $maxColumnT }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header"
                        style="background: linear-gradient(to bottom, rgb(58, 94, 255), rgb(99, 182, 255) 100%) !important; ">
                        <h4 style="color:white">Beban Jatim Tertinggi Siang hari ini</h4>
                    </div>
                    <div class="card-body">
                        <ul>
                            <li>MW: </li>
                            <li>Tanggal : </li>
                            <li>Pukul</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header"
                        style="background: linear-gradient(to bottom, rgb(58, 94, 255), rgb(99, 182, 255) 100%) !important; ">
                        <h4 style="color:white">Realisasi Beban Puncak Jatim Kemarin</h4>
                    </div>
                    <div class="card-body">
                        <ul>
                            <li>MW: </li>
                            <li>Tanggal : </li>
                            <li>Pukul</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header"
                        style="background: linear-gradient(to bottom, rgb(58, 94, 255), rgb(99, 182, 255) 100%) !important; ">
                        <h4 style="color:white">Perkiraan Beban Puncak Jatim Hari Ini</h4>
                    </div>
                    <div class="card-body">
                        <ul>
                            <li>MW: </li>
                            <li>Tanggal : </li>
                            <li>Pukul</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header"
                        style="background: linear-gradient(to bottom, rgb(1, 56, 255), rgb(99, 182, 255) 100%) !important; ">
                        <h4 style="color:white">Tabel Jumlah Feeder UP3</h4>
                    </div>
                    <div class="card-body">

                        <div class="table-responsive">
                            <table class="table table-bordered" id="jumlahfeederup3" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>UP3</th>
                                        <th>Feeder</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header"
                        style="background: linear-gradient(to bottom, rgb(1, 56, 255), rgb(99, 182, 255) 100%) !important; ">
                        <h4 style="color:white">Kenaikan beban dari hari ke hari</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="bebanharikemarin" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>GI</th>
                                        <th>Trafo</th>
                                        <th>%</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header"
                        style="background: linear-gradient(to bottom, rgb(58, 94, 255), rgb(99, 182, 255) 100%) !important; ">
                        <h4 style="color:white">Beban Jatim Tertinggi Siang hari ini</h4>
                    </div>
                    <div class="card-body">
                        <ul>
                            <li>Gardu Induk : </li>
                            <li>Trafo : </li>
                            <li>Kapasitas Trafo :</li>
                            <li>Penyulang :</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header"
                        style="background: linear-gradient(to bottom, rgb(58, 94, 255), rgb(99, 182, 255) 100%) !important; ">
                        <h4 style="color:white">Realisasi Beban Puncak Jatim Kemarin</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <tr>
                                <td>Total Jumlah Penyulang VIP</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Total Jumlah Penyulang Express / Spotload</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">Grafik Pengukuran Tahun ini</h6>
            </div>
            <div class="card-body">
                <div style="width: 100%; height:400px; margin: auto;">
                    <canvas id="barChart"></canvas>
                </div>
                {{-- <div class="row mt-5">
                    <div class="col-md-4">
                        <a href="{{ route('bebanharian') }}" class="btn btn-primary">Beban Harian</a>
                    </div>
                    <div class="col-md-4">
                        <a href="{{ route('bebanminggu') }}" class="btn btn-warning">Beban Mingguan</a>
                    </div>
                    <div class="col-md-4">
                        <a href="{{ route('bebanbulan') }}" class="btn btn-danger">Beban Bulanan</a>
                    </div>
                </div> --}}

            </div>
        </div>

        {{-- <div class="card mt-3">
            <div class="card-header">
                <h5 class="m-0 font-weight-bold text-primary">Beban Sistem Jatim Tahun</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Bulan</th> <!-- Kolom kosong di bagian kiri atas -->
                                @foreach ($nilaiTertinggiPerBulan as $bulan => $nilai)
                                    <th>{{ $bulan }}</th> <!-- Kolom bulan -->
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Beban Tertinggi (MW)</td> <!-- Label di sebelah kiri -->
                                @foreach ($nilaiTertinggiPerBulan as $nilai)
                                    <td>{{ $nilai }}</td> <!-- Nilai beban tertinggi -->
                                @endforeach
                            </tr>
                            <tr>
                                <td>Beban Rata-rata (MW)</td> <!-- Label di sebelah kiri untuk nilai rata-rata -->
                                @foreach ($nilaiRataRataPerBulan as $nilaiRataRata)
                                    <td>{{ $nilaiRataRata }}</td> <!-- Nilai beban rata-rata -->
                                @endforeach
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-primary"><i class="fas fa-fw fa-arrow-down"></i>Download Excel</button>
            </div> --}}
    </div>

    </div>
@endsection

@push('scripts')
    <script src="{{ asset('library/chart.js/dist/Chart.min.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        $("#jumlahfeederup3").dataTable({});
    </script>

    <script>
        $("#bebanharikemarin").dataTable({
            // "columnDefs": [{
            //     "sortable": false,
            //     "targets": [2, 3]
            // }]
        });
    </script>

    <script>
        var ctx = document.getElementById('barChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ["0", "1", "2", "3", "4", "5"],
                datasets: [{
                        label: 'Parameter 1', // Name the series
                        data: ['30', '20', '12', '23', '33', '56'], // Specify the data values array
                        fill: false,
                        borderColor: '#ffd000', // Add custom color border (Line)
                        backgroundColor: '#ffd000', // Add custom color background (Points and Fill)
                        borderWidth: 3 // Specify bar border width
                    },
                    {
                        label: 'Parameter 2',
                        data: ['14', '45', '15', '27', '56', '50'],
                        fill: false,
                        borderColor: '#ff0000', // Add custom color border (Line)
                        backgroundColor: '#ff0000', // Add custom color background (Points and Fill)
                        borderWidth: 3 // Specify bar border width
                    }
                ]
            },
            options: {
                responsive: true, // Instruct chart js to respond nicely.
                maintainAspectRatio: false, // Add to prevent default behaviour of full-width/height
            }
        });
    </script>

    <script>
        var ctx = document.getElementById('chartTahun').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ["0", "1", "2", "3", "4", "5"],
                datasets: [{
                    label: 'Parameter 1', // Name the series
                    data: ['10', '13', '5', '23', '50', '56'], // Specify the data values array
                    fill: false,
                    borderColor: '#ffd000', // Add custom color border (Line)
                    backgroundColor: '#ffd000', // Add custom color background (Points and Fill)
                    borderWidth: 3 // Specify bar border width
                }, ]
            },
            options: {
                responsive: true, // Instruct chart js to respond nicely.
                maintainAspectRatio: false, // Add to prevent default behaviour of full-width/height
                plugins: {
                    title: {
                        display: true,
                        text: 'Beban Jatim Tertinggi Tahun ini',
                        padding: {
                            top: 5,
                        }
                    }
                }
            }
        });
    </script>

    <script>
        var ctx = document.getElementById('chartBulan').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ["0", "1", "2", "3", "4", "5"],
                datasets: [{
                        label: 'Parameter 1', // Name the series
                        data: ['30', '20', '12', '23', '33', '56'], // Specify the data values array
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
                plugins: {
                    title: {
                        display: true,
                        text: 'Beban Jatim Tertinggi Bulan ini',
                        padding: {
                            top: 5,
                        }
                    }
                }
            }
        });
    </script>

    <script>
        var ctx = document.getElementById('chartHari').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ["0", "1", "2", "3", "4", "5"],
                datasets: [{
                        label: 'Parameter 1', // Name the series
                        data: ['30', '20', '12', '23', '33', '56'], // Specify the data values array
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
                plugins: {
                    title: {
                        display: true,
                        text: 'Beban Jatim Tertinggi Hari ini',
                        padding: {
                            top: 5,
                        }
                    }
                }
            }
        });
    </script>

    <!-- JS Libraies -->
    <script src="{{ asset('library/simpleweather/jquery.simpleWeather.min.js') }}"></script>
    <script src="{{ asset('library/chart.js/dist/Chart.min.js') }}"></script>
    <script src="{{ asset('library/jqvmap/dist/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('library/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
    <script src="{{ asset('library/summernote/dist/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('library/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/index-0.js') }}"></script>
@endpush
