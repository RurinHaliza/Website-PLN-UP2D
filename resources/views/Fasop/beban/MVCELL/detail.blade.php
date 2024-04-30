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
                <h1>Detail MVCELL : {{ $data->NAMA_JTM }}</h1>
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
                                <td><strong>ID CELL : </strong></td>
                                @if ($data->ID_CELL == null)
                                    <td><u><strong>Belum Diisi</strong></u></td>
                                @else
                                    <td>{{ $data->ID_CELL }}</td>
                                @endif
    
                                <td><strong>ID KELAS : </strong></td>
                                @if ($data->ID_KELAS == null)
                                    <td><u><strong>Belum Diisi</strong></u></td>
                                @else
                                    <td>{{ $data->ID_KELAS }}</td>
                                @endif
                            </tr>

                            <tr>
                                <td><strong>Lokasi Penempatan : </strong></td>
                                @if ($data->LOKASI_PENEMPATAN == null)
                                    <td><u><strong>Belum Diisi</strong></u></td>
                                @else
                                    <td>{{ $data->LOKASI_PENEMPATAN }}</td>
                                @endif
    
                                <td><strong>MERK : </strong></td>
                                @if ($data->MERK == null)
                                    <td><u><strong>Belum Diisi</strong></u></td>
                                @else
                                    <td>{{ $data->MERK }}</td>
                                @endif
                            </tr>

                            <tr>
                                <td><strong>TYPE : </strong></td>
                                @if ($data->TYPE == null)
                                    <td><u><strong>Belum Diisi</strong></u></td>
                                @else
                                    <td>{{ $data->TYPE }}</td>
                                @endif
    
                                <td><strong>No Seri : </strong></td>
                                @if ($data->NO_SERI == null)
                                    <td><u><strong>Belum Diisi</strong></u></td>
                                @else
                                    <td>{{ $data->NO_SERI }}</td>
                                @endif
                            </tr>

                            <tr>
                                <td><strong>MERK 2: </strong></td>
                                @if ($data->MERK_2 == null)
                                    <td><u><strong>Belum Diisi</strong></u></td>
                                @else
                                    <td>{{ $data->MERK_2 }}</td>
                                @endif
    
                                <td><strong>TYPE 2 : </strong></td>
                                @if ($data->TYPE_2 == null)
                                    <td><u><strong>Belum Diisi</strong></u></td>
                                @else
                                    <td>{{ $data->TYPE_2 }}</td>
                                @endif
                            </tr>

                            <tr>
                                <td><strong>NO Seri 2 : </strong></td>
                                @if ($data->NO_SERI_2 == null)
                                    <td><u><strong>Belum Diisi</strong></u></td>
                                @else
                                    <td>{{ $data->NO_SERI_2 }}</td>
                                @endif
    
                                <td><strong>JENIS : </strong></td>
                                @if ($data->JENIS == null)
                                    <td><u><strong>Belum Diisi</strong></u></td>
                                @else
                                    <td>{{ $data->JENIS }}</td>
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
