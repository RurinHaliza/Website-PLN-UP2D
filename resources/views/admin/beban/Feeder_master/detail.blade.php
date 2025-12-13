@extends('layouts.app')

@section('title', 'Detail Data Feeder')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.min.css') }}">
    {{-- Tambahkan CSS lain jika diperlukan --}}
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Detail Informasi Feeder</h1>
            </div>
        </section>
        
        {{-- Tombol kembali menggunakan fungsi url()->previous() yang lebih fleksibel --}}
        <a href="{{ url()->previous() }}" class="btn btn-danger">Kembali</a>
        {{-- Atau jika Anda ingin kembali ke rute bernama 'bebanpenyulang', gunakan: 
        <a href="{{ route('bebanpenyulang') }}" class="btn btn-danger">Kembali</a> --}}

        <div class="card mt-3">
            <div class="card-header">
                <h5 class="m-0 font-weight-bold text-primary">Detail Rincian Data Feeder</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive mt-3">
                    <table id="detail" class="table table-hover" style="width:100%">
                        <tbody>
                            {{-- Baris 1: ID dan Gardu Induk --}}
                            <tr>
                                <td><strong>PKEY ID : </strong></td>
                                @if ($data->feeder_pkey == null)
                                    <td><u><strong>Belum Diisi</strong></u></td>
                                @else
                                    <td>{{ $data->feeder_pkey }}</td>
                                @endif
                                
                                <td><strong>Gardu Induk (GI) : </strong></td>
                                @if ($data->gardu_induk == null)
                                    <td><u><strong>Belum Diisi</strong></u></td>
                                @else
                                    <td>{{ $data->gardu_induk }}</td>
                                @endif
                            </tr>

                            {{-- Baris 2: Nama dan MV Cell --}}
                            <tr>
                                <td><strong>Nama Feeder : </strong></td>
                                @if ($data->name == null)
                                    <td><u><strong>Belum Diisi</strong></u></td>
                                @else
                                    <td>{{ $data->name }}</td>
                                @endif
                                
                                <td><strong>MV Cell : </strong></td>
                                @if ($data->mvcell == null)
                                    <td><u><strong>Belum Diisi</strong></u></td>
                                @else
                                    <td>{{ $data->mvcell }}</td>
                                @endif
                            </tr>

                            {{-- Baris 3: Parameter Trafo (T_Primary, T_Secondary) --}}
                            <tr>
                                <td><strong>T Primary : </strong></td>
                                @if ($data->t_primary == null)
                                    <td><u><strong>Belum Diisi</strong></u></td>
                                @else
                                    <td>{{ $data->t_primary }}</td>
                                @endif
                                
                                <td><strong>T Secondary : </strong></td>
                                @if ($data->t_secondary == null)
                                    <td><u><strong>Belum Diisi</strong></u></td>
                                @else
                                    <td>{{ $data->t_secondary }}</td>
                                @endif
                            </tr>

                            {{-- Baris 4: Parameter Trafo (T_Daya, T_No) --}}
                            <tr>
                                <td><strong>T Daya : </strong></td>
                                @if ($data->t_daya == null)
                                    <td><u><strong>Belum Diisi</strong></u></td>
                                @else
                                    <td>{{ $data->t_daya }}</td>
                                @endif
                                
                                <td><strong>T No : </strong></td>
                                @if ($data->t_no == null)
                                    <td><u><strong>Belum Diisi</strong></u></td>
                                @else
                                    <td>{{ $data->t_no }}</td>
                                @endif
                            </tr>

                            {{-- Baris 5: KMS dan L/R --}}
                            <tr>
                                <td><strong>KMS (km) : </strong></td>
                                @if ($data->kms == null)
                                    <td><u><strong>Belum Diisi</strong></u></td>
                                @else
                                    <td>{{ $data->kms }}</td>
                                @endif
                                
                                {{-- Kolom L/R di database Anda mungkin namanya 'l/r' atau 'L_R' --}}
                                <td><strong>L/R : </strong></td>
                                @if ($data->{'l/r'} == null) {{-- Jika nama kolom mengandung karakter khusus (misal '/') --}}
                                    <td><u><strong>Belum Diisi</strong></u></td>
                                @else
                                    <td>{{ $data->{'l/r'} }}</td>
                                @endif
                            </tr>

                            {{-- Baris 6: UP3 dan Kelas --}}
                            <tr>
                                <td><strong>UP3 : </strong></td>
                                @if ($data->up3 == null)
                                    <td><u><strong>Belum Diisi</strong></u></td>
                                @else
                                    <td>{{ $data->up3 }}</td>
                                @endif
                                
                                <td><strong>Kelas : </strong></td>
                                @if ($data->kelas == null)
                                    <td><u><strong>Belum Diisi</strong></u></td>
                                @else
                                    <td>{{ $data->kelas }}</td>
                                @endif
                            </tr>

                            {{-- Baris 7: Proteksi dan Pelanggan --}}
                            <tr>
                                <td><strong>Inom (A) : </strong></td>
                                @if ($data->inom == null)
                                    <td><u><strong>Belum Diisi</strong></u></td>
                                @else
                                    <td>{{ $data->inom }}</td>
                                @endif
                                
                                <td><strong>Pelanggan : </strong></td>
                                @if ($data->pelanggan == null)
                                    <td><u><strong>Belum Diisi</strong></u></td>
                                @else
                                    <td>{{ $data->pelanggan }}</td>
                                @endif
                            </tr>

                            {{-- Baris 8: Iset --}}
                            <tr>
                                <td><strong>Iset (A) : </strong></td>
                                @if ($data->iset == null)
                                    <td><u><strong>Belum Diisi</strong></u></td>
                                @else
                                    <td>{{ $data->iset }}</td>
                                @endif

                                {{-- Kolom ini dikosongkan untuk keseimbangan tabel --}}
                                <td></td> 
                                <td></td> 
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    {{-- Hapus script datatables yang tidak diperlukan di halaman detail --}}
    <script>
        // Tidak ada script khusus yang diperlukan untuk detail, jadi bagian ini bisa kosong atau dihapus
    </script>
@endpush