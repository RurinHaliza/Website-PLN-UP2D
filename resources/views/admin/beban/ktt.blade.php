@extends('layouts.app')

@section('title', 'General Dashboard')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet"
        href="{{ asset('library/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('library/summernote/dist/summernote-bs4.min.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Beban KTT</h1>
            </div>
        </section>
        <div class="card mt-3">
            <div class="card-header">
                <h5 class="m-0 font-weight-bold text-primary">Tabel Pengukuran</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Pkey</th>
                                <th>Station</th>
                                <th>Nama</th>
                                <th>Daya</th>
                                <th>Alamat</th>
                                <th>Tanggal</th>
                                <th>Cb</th>
                                <th>Meter</th>
                                <th>Status Meter</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $no = 1;
                        @endphp

                            @foreach ($bebanktt as $ktt)
                            <tr>
                                <td>{{$no++}}</td>
                                <td>{{$ktt->pkey}}</td>
                                <td>{{$ktt->station}}</td>
                                <td>{{$ktt->nama}}</td>
                                <td>{{$ktt->daya}}</td>
                                <td>{{$ktt->alamat}}</td>
                                <td>{{$ktt->tanggal}}</td>
                                <td>{{$ktt->cb}}</td>
                                <td>{{$ktt->meter}}</td>
                                <td>{{$ktt->status_meter}}</td>
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
    $("#beban_ktt").dataTable({
        "columnDefs": [{
            "sortable": false,
            "targets": [2, 3]
        }]
    });
</script>
@endpush
