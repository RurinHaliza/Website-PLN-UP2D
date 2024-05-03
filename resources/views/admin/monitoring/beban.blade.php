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
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div style="width: 100%; height:170px; margin: auto;">
                            <canvas id="chartBulan"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div style="width: 100%; height:170px; margin: auto;">
                            <canvas id="ChartHarian"></canvas>
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
                            <li>Tanggal : {{ $maxDateYear }}</li>
                            <li>Pukul : {{ $maxColumnYear }}</li>
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
                            <li>Tanggal : {{ $maxDateMonth }}</li>
                            <li>Pukul : {{ $maxColumnMonth }}</li>
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
                            <li>MW: {{ $maxValueToday }}</li>
                            <li>Tanggal : {{ $selectedDate }} </li>
                            <li>Pukul : {{ $maxColumnToday }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"
                        style="background: linear-gradient(to bottom, rgb(1, 56, 255), rgb(99, 182, 255) 100%) !important; ">
                        <h4 style="color:white">Kenaikan beban dari hari ke hari</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            @if ($data->count() > 0)
                                <table class="table table-bordered" id="bebanharikemarin" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Gardu Induk</th>
                                            <th>Incoming</th>
                                            <th>Total Hari Ini</th>
                                            <th>Total Kemarin</th>
                                            <th>Total Kemarin Lusa</th>
                                            <th>Kenaikan</th>
                                            <th>Perbandingan</th>
                                            <th>00.30</th>
                                        <th>01.00</th>
                                        <th>01.30</th>
                                        <th>02.00</th>
                                        <th>02.30</th>
                                        <th>03.00</th>
                                        <th>03.30</th>
                                        <th>04.00</th>
                                        <th>04.30</th>
                                        <th>05.00</th>
                                        <th>05.30</th>
                                        <th>06.00</th>
                                        <th>06.30</th>
                                        <th>07.00</th>
                                        <th>07.30</th>
                                        <th>08.00</th>
                                        <th>08.30</th>
                                        <th>09.00</th>
                                        <th>09.30</th>
                                        <th>10.00</th>
                                        <th>10.30</th>
                                        <th>11.00</th>
                                        <th>11.30</th>
                                        <th>12.00</th>
                                        <th>12.30</th>
                                        <th>13.00</th>
                                        <th>13.30</th>
                                        <th>14.00</th>
                                        <th>14.30</th>
                                        <th>15.00</th>
                                        <th>15.30</th>
                                        <th>16.00</th>
                                        <th>16.30</th>
                                        <th>17.00</th>
                                        <th>17.30</th>
                                        <th>18.00</th>
                                        <th>18.30</th>
                                        <th>19.00</th>
                                        <th>19.30</th>
                                        <th>20.00</th>
                                        <th>20.30</th>
                                        <th>21.00</th>
                                        <th>21.30</th>
                                        <th>22.00</th>
                                        <th>22.30</th>
                                        <th>23.00</th>
                                        <th>23.30</th>
                                        <th>23.59</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $item)
                                            <tr>
                                                <td>{{ $item->gardu_induk }}</td>
                                                <td>{{ $item->incoming }}</td>
                                                <td>{{ $item->total_today }}</td>
                                                <td>{{ $item->total_yesterday }}</td>
                                                <td>{{ $item->total_day_before_yesterday }}</td>
                                                <td>{{ $item->increase }}</td>
                                                <td>{{ $item->comparison }}</td>
                                                <td>{{ $item->{'00_30'} }}</td>
                                                <td>{{ $item->{'01_00'} }}</td>
                                                <td>{{ $item->{'01_30'} }}</td>
                                                <td>{{ $item->{'02_00'} }}</td>
                                                <td>{{ $item->{'02_30'} }}</td>
                                                <td>{{ $item->{'03_00'} }}</td>
                                                <td>{{ $item->{'03_30'} }}</td>
                                                <td>{{ $item->{'04_00'} }}</td>
                                                <td>{{ $item->{'04_30'} }}</td>
                                                <td>{{ $item->{'05_00'} }}</td>
                                                <td>{{ $item->{'05_30'} }}</td>
                                                <td>{{ $item->{'06_00'} }}</td>
                                                <td>{{ $item->{'06_30'} }}</td>
                                                <td>{{ $item->{'07_00'} }}</td>
                                                <td>{{ $item->{'07_30'} }}</td>
                                                <td>{{ $item->{'08_00'} }}</td>
                                                <td>{{ $item->{'08_30'} }}</td>
                                                <td>{{ $item->{'09_00'} }}</td>
                                                <td>{{ $item->{'09_30'} }}</td>
                                                <td>{{ $item->{'10_00'} }}</td>
                                                <td>{{ $item->{'10_30'} }}</td>
                                                <td>{{ $item->{'11_00'} }}</td>
                                                <td>{{ $item->{'11_30'} }}</td>
                                                <td>{{ $item->{'12_00'} }}</td>
                                                <td>{{ $item->{'12_30'} }}</td>
                                                <td>{{ $item->{'13_00'} }}</td>
                                                <td>{{ $item->{'13_30'} }}</td>
                                                <td>{{ $item->{'14_00'} }}</td>
                                                <td>{{ $item->{'14_30'} }}</td>
                                                <td>{{ $item->{'15_00'} }}</td>
                                                <td>{{ $item->{'15_30'} }}</td>
                                                <td>{{ $item->{'16_00'} }}</td>
                                                <td>{{ $item->{'16_30'} }}</td>
                                                <td>{{ $item->{'17_00'} }}</td>
                                                <td>{{ $item->{'17_30'} }}</td>
                                                <td>{{ $item->{'18_00'} }}</td>
                                                <td>{{ $item->{'18_30'} }}</td>
                                                <td>{{ $item->{'19_00'} }}</td>
                                                <td>{{ $item->{'19_30'} }}</td>
                                                <td>{{ $item->{'20_00'} }}</td>
                                                <td>{{ $item->{'20_30'} }}</td>
                                                <td>{{ $item->{'21_00'} }}</td>
                                                <td>{{ $item->{'21_30'} }}</td>
                                                <td>{{ $item->{'22_00'} }}</td>
                                                <td>{{ $item->{'22_30'} }}</td>
                                                <td>{{ $item->{'23_00'} }}</td>
                                                <td>{{ $item->{'23_30'} }}</td>
                                                <td>{{ $item->{'23_59'} }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <table id="bebanhari" class="table-bordered table-md-6 table">
                                    <tr>
                                        <th>Gardu Induk</th>
                                        <th>Incoming</th>
                                        <th>Total Hari Ini</th>
                                        <th>Total Kemarin</th>
                                        <th>Total Kemarin Lusa</th>
                                        <th>Kenaikan</th>
                                        <th>Perbandingan</th>
                                        <th>00.30</th>
                                        <th>01.00</th>
                                        <th>01.30</th>
                                        <th>02.00</th>
                                        <th>02.30</th>
                                        <th>03.00</th>
                                        <th>03.30</th>
                                        <th>04.00</th>
                                        <th>04.30</th>
                                        <th>05.00</th>
                                        <th>05.30</th>
                                        <th>06.00</th>
                                        <th>06.30</th>
                                        <th>07.00</th>
                                        <th>07.30</th>
                                        <th>08.00</th>
                                        <th>08.30</th>
                                        <th>09.00</th>
                                        <th>09.30</th>
                                        <th>10.00</th>
                                        <th>10.30</th>
                                        <th>11.00</th>
                                        <th>11.30</th>
                                        <th>12.00</th>
                                        <th>12.30</th>
                                        <th>13.00</th>
                                        <th>13.30</th>
                                        <th>14.00</th>
                                        <th>14.30</th>
                                        <th>15.00</th>
                                        <th>15.30</th>
                                        <th>16.00</th>
                                        <th>16.30</th>
                                        <th>17.00</th>
                                        <th>17.30</th>
                                        <th>18.00</th>
                                        <th>18.30</th>
                                        <th>19.00</th>
                                        <th>19.30</th>
                                        <th>20.00</th>
                                        <th>20.30</th>
                                        <th>21.00</th>
                                        <th>21.30</th>
                                        <th>22.00</th>
                                        <th>22.30</th>
                                        <th>23.00</th>
                                        <th>23.30</th>
                                        <th>23.59</th>
                                    </tr>
                                </table>
                            @endif
                        </div>
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
        <div>

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
                        data: [ '45', '15', '27', '56', '50'], // Specify the data values array
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
         // Mendapatkan data dari controller yang dipassing dari PHP
         
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ["0", "1", "2", "3", "4", "5"],
                datasets: [{
                    label: 'Parameter 1', // Name the series
                    data: , // Specify the data values array
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
                labels: ["5 Bulan yang lalu", "4 Bulan yang lalu", "3 Bulan yang lalu", "Bulan kemarin", "Bulan ini"],
                datasets: [{
                        label: 'Parameter 1', // Name the series
                        data: [{{ $totalBulanlima }},{{ $totalBulanempat }},{{ $totalBulanKemarinLusa }},{{ $totalBulanKemarin }}, {{ $totalBulanIni }},
                        ], // Specify the data values array
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
                        text: 'Total Mw',
                        padding: {
                            top: 5,
                        }
                    }
                }
            }
        });
    </script>
    <script>
        var ctx = document.getElementById('ChartHarian').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ["5 Hari yang lalu", "4 Hari yang lalu", "3 Hari yang lalu", "Kemarin", "Hari ini", ],
                datasets: [{
                        label: 'Parameter 1', // Name the series
                        data: [{{ $dataharike5 }}, {{ $dataharike4 }}, {{ $dataharike3 }},
                            {{ $dataharike2 }}, {{ $dataharike1 }}
                        ], // Specify the data values array
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
                        text: 'Total Mw',
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
