@extends('layouts.app')

@section('title', 'Penyulang')

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
                <h1>Detail Informasi Penyulang </h1>
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
                                <td><strong>ID_JTM : </strong></td>
                                @if ($data->ID_JTM == null)
                                    <td><u><strong>Belum Diisi</strong></u></td>
                                @else
                                    <td>{{ $data->ID_JTM }}</td>
                                @endif
    
                                <td><strong>ID_GI : </strong></td>
                                @if ($data->ID_GI == null)
                                    <td><u><strong>Belum Diisi</strong></u></td>
                                @else
                                    <td>{{ $data->ID_GI }}</td>
                                @endif
                            </tr>

                            <tr>
                                <td><strong>ID_TRAFOGI : </strong></td>
                                @if ($data->ID_TRAFOGI == null)
                                    <td><u><strong>Belum Diisi</strong></u></td>
                                @else
                                    <td>{{ $data->ID_TRAFOGI }}</td>
                                @endif
    
                                <td><strong>NM_JTM : </strong></td>
                                @if ($data->NM_JTM == null)
                                    <td><u><strong>Belum Diisi</strong></u></td>
                                @else
                                    <td>{{ $data->NM_JTM }}</td>
                                @endif
                            </tr>

                            <tr>
                                <td><strong>Nama GI : </strong></td>
                                @if ($data->NM_GI == null)
                                    <td><u><strong>Belum Diisi</strong></u></td>
                                @else
                                    <td>{{ $data->NM_GI }}</td>
                                @endif
    
                                <td><strong>Singkatan : </strong></td>
                                @if ($data->NM_SINGKATAN == null)
                                    <td><u><strong>Belum Diisi</strong></u></td>
                                @else
                                    <td>{{ $data->NM_SINGKATAN }}</td>
                                @endif
                            </tr>

                            <tr>
                                <td><strong>UP3 : </strong></td>
                                @if ($data->UP3 == null)
                                    <td><u><strong>Belum Diisi</strong></u></td>
                                @else
                                    <td>{{ $data->UP3 }}</td>
                                @endif
    
                                <td><strong>ULP : </strong></td>
                                @if ($data->ULP == null)
                                    <td><u><strong>Belum Diisi</strong></u></td>
                                @else
                                    <td>{{ $data->ULP }}</td>
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
