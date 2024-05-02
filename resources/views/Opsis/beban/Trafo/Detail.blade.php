@extends('layouts.app')

@section('title', 'Trafo')

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
                <h1>Detail Informasi Trafo : {{ $data->TRAFO }}</h1>
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
                                <td><strong>Nama_GI : </strong></td>
                                @if ($data->Nama_GI == null)
                                    <td><u><strong>Belum Diisi</strong></u></td>
                                @else
                                    <td>{{ $data->Nama_GI }}</td>
                                @endif
    
                                <td><strong>TRAFO : </strong></td>
                                @if ($data->TRAFO == null)
                                    <td><u><strong>Belum Diisi</strong></u></td>
                                @else
                                    <td>{{ $data->TRAFO }}</td>
                                @endif

                                <td><strong>ID_TRAFO : </strong></td>
                                @if ($data->ID_TRAFO == null)
                                    <td><u><strong>Belum Diisi</strong></u></td>
                                @else
                                    <td>{{ $data->ID_TRAFO }}</td>
                                @endif

                            </tr>

                            <tr>
                                <td><strong>ID_KELAS : </strong></td>
                                @if ($data->ID_KELAS == null)
                                    <td><u><strong>Belum Diisi</strong></u></td>
                                @else
                                    <td>{{ $data->ID_KELAS }}</td>
                                @endif
    
                                <td><strong>KD_PEMILIK : </strong></td>
                                @if ($data->KD_PEMILIK == null)
                                    <td><u><strong>Belum Diisi</strong></u></td>
                                @else
                                    <td>{{ $data->KD_PEMILIK }}</td>
                                @endif

                                <td><strong>KD_PENGELOLA : </strong></td>
                                @if ($data->KD_PENGELOLA == null)
                                    <td><u><strong>Belum Diisi</strong></u></td>
                                @else
                                    <td>{{ $data->KD_PENGELOLA }}</td>
                                @endif

                            </tr>

                            <tr>
                                <td><strong>TINGKAT_RESIKO : </strong></td>
                                @if ($data->TINGKAT_RESIKO == null)
                                    <td><u><strong>Belum Diisi</strong></u></td>
                                @else
                                    <td>{{ $data->TINGKAT_RESIKO }}</td>
                                @endif
    
                                <td><strong>KODE_PERALATAN : </strong></td>
                                @if ($data->KODE_PERALATAN == null)
                                    <td><u><strong>Belum Diisi</strong></u></td>
                                @else
                                    <td>{{ $data->KODE_PERALATAN }}</td>
                                @endif

                                <td><strong>MERK : </strong></td>
                                @if ($data->MERK == null)
                                    <td><u><strong>Belum Diisi</strong></u></td>
                                @else
                                    <td>{{ $data->MERK }}</td>
                                @endif

                            </tr>

                            <tr>
                                <td><strong>NO_SERI : </strong></td>
                                @if ($data->NO_SERI == null)
                                    <td><u><strong>Belum Diisi</strong></u></td>
                                @else
                                    <td>{{ $data->NO_SERI }}</td>
                                @endif
    
                                <td><strong>PERUNTUKAN : </strong></td>
                                @if ($data->PERUNTUKAN == null)
                                    <td><u><strong>Belum Diisi</strong></u></td>
                                @else
                                    <td>{{ $data->PERUNTUKAN }}</td>
                                @endif

                                <td><strong>JENIS : </strong></td>
                                @if ($data->JENIS == null)
                                    <td><u><strong>Belum Diisi</strong></u></td>
                                @else
                                    <td>{{ $data->JENIS }}</td>
                                @endif

                            </tr>

                            <tr>
                                <td><strong>STATUS : </strong></td>
                                @if ($data->STATUS == null)
                                    <td><u><strong>Belum Diisi</strong></u></td>
                                @else
                                    <td>{{ $data->STATUS }}</td>
                                @endif
    
                                <td><strong>TGL_PASANG : </strong></td>
                                @if ($data->TGL_PASANG == null)
                                    <td><u><strong>Belum Diisi</strong></u></td>
                                @else
                                    <td>{{ $data->TGL_PASANG }}</td>
                                @endif

                                <td><strong>TGL_OPERASI : </strong></td>
                                @if ($data->TGL_OPERASI == null)
                                    <td><u><strong>Belum Diisi</strong></u></td>
                                @else
                                    <td>{{ $data->TGL_OPERASI }}</td>
                                @endif

                            </tr>

                            <tr>
                                <td><strong>NILAI_PEROLEHAN : </strong></td>
                                @if ($data->NILAI_PEROLEHAN == null)
                                    <td><u><strong>Belum Diisi</strong></u></td>
                                @else
                                    <td>{{ $data->NILAI_PEROLEHAN }}</td>
                                @endif
    
                                <td><strong>NILAI_BUKU : </strong></td>
                                @if ($data->NILAI_BUKU == null)
                                    <td><u><strong>Belum Diisi</strong></u></td>
                                @else
                                    <td>{{ $data->NILAI_BUKU }}</td>
                                @endif

                                <td><strong>UMUR_EKONOMIS : </strong></td>
                                @if ($data->UMUR_EKONOMIS == null)
                                    <td><u><strong>Belum Diisi</strong></u></td>
                                @else
                                    <td>{{ $data->UMUR_EKONOMIS }}</td>
                                @endif

                            </tr>

                            <tr>
                                <td><strong>UMUR_MANFAAT : </strong></td>
                                @if ($data->UMUR_MANFAAT == null)
                                    <td><u><strong>Belum Diisi</strong></u></td>
                                @else
                                    <td>{{ $data->UMUR_MANFAAT }}</td>
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
