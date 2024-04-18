@extends('layouts.app')

@section('title', 'Gardu Induk')

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
                <h1>Data GI (Gardu Induk)</h1>
            </div>
        </section>
        <div class="card mt-3">
            <div class="card-header">
                <h5 class="m-0 font-weight-bold text-primary">Tabel Pengukuran</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="table-1" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>ID FGI</th>
                                <th>Nama GI</th>
                                <th>Nama Singkatan</th>
                                <th>KD Pemilik</th>
                                <th>KD Pengelola</th>
                                <th>Tingkat Resiko</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @php
                                $no = 1;
                            @endphp

                            @foreach ($GI as $g)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $g->ID_FGI }}</td>
                                    <td>{{ $g->Nama_GI }}</td>
                                    <td>{{ $g->NAMA_SINGKATAN }}</td>
                                    <td>{{ $g->KD_Pemilik }}</td>
                                    <td>{{ $g->KD_Pengelola }}</td>
                                    <td>{{ $g->tingkat_resiko }}</td>
                                    {{-- <td><a href="" class="btn btn-primary">Detail</a></td> --}}
                                </tr>
                            @endforeach

                        </tbody>

                    </table>
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-primary"><i class="fas fa-fw fa-arrow-down"></i>Download Excel</button>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    {{-- <!-- JS Libraies -->
    <script src="{{ asset('library/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('library/jquery-ui-dist/jquery-ui.min.js') }}"></script> --}}

    <script>
        $("#table-1").dataTable({
            "columnDefs": [{
                "sortable": false,
                "targets": [2, 3]
            }]
        });
    </script>
@endpush
