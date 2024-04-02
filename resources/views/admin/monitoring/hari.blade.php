@extends('layouts.app')

@section('title', 'Beban Harian')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.min.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Beban Harian</h1>
            </div>
        </section>

        <div class="card mt-3">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">Grafik Pengukuran Hari ini</h6>
            </div>
            <div class="card-body">
                <div style="width: 100%; height:400px; margin: auto;">
                    <canvas id="barChart"></canvas>
                </div>
            </div>
        </div>
        <div class="card mt-3">
            <div class="card-header">
                <h5 class="m-0 font-weight-bold text-primary">Tabel Pengukuran</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="bebanharian" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Jumlah Gardu Induk</th>
                                <th>Jumlah Trafo</th>
                                <th>Jumlah Feeder</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        @foreach ($databebanpuncak30 as $databebanpuncak)
                            <tr>
                                <td>{{ $databebanpuncak->id }}</td>
                                <td>{{ $databebanpuncak->feeder_pkey }}</td>
                                <td>{{ $databebanpuncak->gardu_induk }}</td>
                                <td></td>
                                <td><a href="" class="btn btn-warning">Detail</a></td>
                            </tr>
                        @endforeach
                    </table>
                    {{-- {{ $databebanpuncak30->links() }} --}}
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-primary"><i class="fas fa-fw fa-arrow-down"></i>Download Excel</button>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $("#bebanharian").dataTable({
            "columnDefs": [{
                "sortable": false,
                "targets": [2, 3]
            }]
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


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
@endpush
