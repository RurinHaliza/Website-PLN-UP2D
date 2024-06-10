@extends('layouts.app')

@section('title', 'General Dashboard')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.min.css') }}">
    <link href="{{ asset('library/datatables/media/css/jquery.dataTables.min.css') }}" rel="stylesheet">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Data Trafo</h1>
            </div>
        </section>
        <div class="card mt-3">
            <div class="card-header">
                <h5 class="m-0 font-weight-bold text-primary">Tabel Pengukuran</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="trafo" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nama Gardu Induk</th>
                                <th>ID Trafo</th>
                                <th>ID Kelas</th>
                                <th>KD Pemilik</th>
                                <th>KD Pengelola</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @php

                                $no = 1;

                            @endphp
                            @foreach ($trafo as $t)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $t->Nama_GI }}</td>
                                    <td>{{ $t->ID_TRAFO }}</td>
                                    <td>{{ $t->ID_KELAS }}</td>
                                    <td>{{ $t->KD_PEMILIK }}</td>
                                    <td>{{ $t->KD_PENGELOLA }}</td>
                                    <td><a href="{{ route('trafo.detail.manager',[$t->id]) }}" class="btn btn-primary">Detail</a></td>
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

<script>
    $("#trafo").dataTable({
        "columnDefs": [{
            "sortable": false,
            "targets": [2, 3]
        }]
    });
</script>

@endpush
