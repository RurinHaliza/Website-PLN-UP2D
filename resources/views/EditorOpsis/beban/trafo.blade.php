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
                <h1>Beban Trafo</h1>
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
                                <th>Nama Gardu Induk</th>
                                <th>ID Trafo</th>
                                <th>ID Kelas</th>
                                <th>KD Pemilik</th>
                                <th>KD Pengelola</th>
                                <th>Tingkat Resiko</th>
                                <th>Kode Peralatan</th>
                                <th>Merk</th>
                                <th>No Seri</th>
                                <th>Peruntukan</th>
                                <th>Jenis</th>
                                <th>Status</th>
                                <th>TGL Pasang</th>
                                <th>TGL Operasi</th>
                                <th>Nilai Perolehan</th>
                                <th>Nilai Buku</th>
                                <th>Umur Ekonomis</th>
                                <th>Umur Manfaat</th>
                                <th>Action</th>
                            </tr>
                        </thead>
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
    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/index-0.js') }}"></script>

    <!-- JS Libraies -->
    <script src="{{ asset('library/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('library/jquery-ui-dist/jquery-ui.min.js') }}"></script>
@endpush
