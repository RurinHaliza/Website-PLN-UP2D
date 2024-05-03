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
                <h1>Detail Konsumen Tegangan Tinggi </h1>
            </div>
        </section>
        <a href="{{ url()->previous() }}" class="btn btn-danger">Kembali</a>

        <div class="card mt-3">
            <div class="card-header">
                <h5 class="m-0 font-weight-bold text-primary">Detail Rincian Data</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive mt-3">
                    <table id="detail" class="table table-hover" style="width:100%">
                        <tbody>
                            <tr>
                                <td><strong>PKEY : </strong></td>
                                @if ($data->pkey == null)
                                    <td><u><strong>Belum Diisi</strong></u></td>
                                @else
                                    <td>{{ $data->pkey }}</td>
                                @endif
    
                                <td><strong>Station : </strong></td>
                                @if ($data->station == null)
                                    <td><u><strong>Belum Diisi</strong></u></td>
                                @else
                                    <td>{{ $data->station }}</td>
                                @endif
                            </tr>
                            <tr>
                                <td><strong>Nama : </strong></td>
                                @if ($data->nama == null)
                                    <td><u><strong>Belum Diisi</strong></u></td>
                                @else
                                    <td>{{ $data->nama }}</td>
                                @endif

                                <td><strong>Daya : </strong></td>
                                @if ($data->daya == null)
                                    <td><u><strong>Belum Diisi</strong></u></td>
                                @else
                                    <td>{{ $data->daya }}</td>
                                @endif
                            </tr>
                            <tr>
                                <td><strong>Alamat : </strong></td>
                                @if ($data->alamat == null)
                                    <td><u><strong>Belum Diisi</strong></u></td>
                                @else
                                    <td>{{ $data->alamat }}</td>
                                @endif

                                <td><strong>Tanggal : </strong></td>
                                @if ($data->tanggal == null)
                                    <td><u><strong>Belum Diisi</strong></u></td>
                                @else
                                    <td>{{ $data->tanggal }}</td>
                                @endif
                            </tr>
                            <tr>
                                <td><strong>Meter : </strong></td>
                                @if ($data->meter	 == null)
                                    <td><u><strong>Belum Diisi</strong></u></td>
                                @else
                                    <td>{{ $data->meter	 }}</td>
                                @endif

                                <td><strong>Status Meter : </strong></td>
                                @if ($data->status_meter == null)
                                    <td><u><strong>Belum Diisi</strong></u></td>
                                @else
                                    <td>{{ $data->status_meter }}</td>
                                @endif
                            </tr>
                        </tbody>
                    </table>
                </div>
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
