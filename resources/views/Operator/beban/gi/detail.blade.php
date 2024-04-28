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
                <h1>Detail Informasi Gardu Induk </h1>
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
                                <td><strong>ID_FGI : </strong></td>
                                @if ($data->ID_FGI == null)
                                    <td><u><strong>Belum Diisi</strong></u></td>
                                @else
                                    <td>{{ $data->ID_FGI }}</td>
                                @endif
    
                                <td><strong>Nama : </strong></td>
                                @if ($data->Nama_GI == null)
                                    <td><u><strong>Belum Diisi</strong></u></td>
                                @else
                                    <td>{{ $data->Nama_GI }}</td>
                                @endif
                            </tr>

                            <tr>
                                <td><strong>Nama singkatan : </strong></td>
                                @if ($data->NAMA_SINGKATAN == null)
                                    <td><u><strong>Belum Diisi</strong></u></td>
                                @else
                                    <td>{{ $data->NAMA_SINGKATAN }}</td>
                                @endif
    
                                <td><strong>KD Pemilik : </strong></td>
                                @if ($data->KD_Pemilik == null)
                                    <td><u><strong>Belum Diisi</strong></u></td>
                                @else
                                    <td>{{ $data->KD_Pemilik }}</td>
                                @endif
                            </tr>

                            <tr>
                                <td><strong>KD Pengelola : </strong></td>
                                @if ($data->KD_Pengelola == null)
                                    <td><u><strong>Belum Diisi</strong></u></td>
                                @else
                                    <td>{{ $data->KD_Pengelola }}</td>
                                @endif
    
                                <td><strong>Tingkat Resiko : </strong></td>
                                @if ($data->tingkat_resiko == null)
                                    <td><u><strong>Belum Diisi</strong></u></td>
                                @else
                                    <td>{{ $data->tingkat_resiko }}</td>
                                @endif
                            </tr>


                            <tr>
                                <td><strong>Koordinat X : </strong></td>
                                @if ($data->x == null)
                                    <td><u><strong>Belum Diisi</strong></u></td>
                                @else
                                    <td>{{ $data->x }}</td>
                                @endif
    
                                <td><strong>Kordinat Y : </strong></td>
                                @if ($data->y == null)
                                    <td><u><strong>Belum Diisi</strong></u></td>
                                @else
                                    <td>{{ $data->y }}</td>
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
