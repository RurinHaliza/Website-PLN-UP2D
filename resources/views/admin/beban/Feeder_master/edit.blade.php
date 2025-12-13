@extends('layouts.app')

@section('title', 'Edit Data Feeder Master')

@push('style')
    <!-- CSS Libraries (jika perlu, biarkan saja) -->
    <link rel="stylesheet" href="{{ asset('library/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.min.css') }}">
@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit Data Feeder</h1>
        </div>
    </section>

    {{-- Tombol Kembali ke halaman sebelumnya --}}
    <a href="{{ route('bebanpenyulang') }}" class="btn btn-danger mb-3">Kembali</a>

    <div class="row">
        {{-- KOLOM UTAMA (8) UNTUK FORM --}}
        <div class="col-md-8">
            <div class="card mt-3">
                <div class="card-header">
                    <h5 class="m-0 font-weight-bold text-primary">Form Edit Data Feeder</h5>
                </div>
                <div class="card-body">

                    {{-- Menangani pesan validasi --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $err)
                                    <li>{{ $err }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- Menggunakan route update standar (feeder.update) --}}
                    <form action="{{ route('feeder.update', $feeder->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        {{-- BARIS 1: feeder_pkey & gardu_induk --}}
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="feeder_pkey" class="form-label">Feeder PKEY</label>
                                <input type="text" class="form-control @error('feeder_pkey') is-invalid @enderror" 
                                       name="feeder_pkey" id="feeder_pkey"
                                       value="{{ old('feeder_pkey', $feeder->feeder_pkey) }}" required>
                                @error('feeder_pkey')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label for="gardu_induk" class="form-label">Gardu Induk</label>
                                <input type="text" class="form-control @error('gardu_induk') is-invalid @enderror" 
                                       name="gardu_induk" id="gardu_induk"
                                       value="{{ old('gardu_induk', $feeder->gardu_induk) }}" required>
                                @error('gardu_induk')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        {{-- BARIS 2: t_no & t_primary --}}
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="t_no" class="form-label">T. NO</label>
                                <input type="text" class="form-control @error('t_no') is-invalid @enderror" 
                                       name="t_no" id="t_no"
                                       value="{{ old('t_no', $feeder->t_no) }}">
                                @error('t_no')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label for="t_primary" class="form-label">T. Primary (A)</label>
                                <input type="number" step="0.01" class="form-control @error('t_primary') is-invalid @enderror" 
                                       name="t_primary" id="t_primary"
                                       value="{{ old('t_primary', $feeder->t_primary) }}">
                                @error('t_primary')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        {{-- BARIS 3: t_secondary & t_daya --}}
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="t_secondary" class="form-label">T. Secondary (A)</label>
                                <input type="number" step="0.01" class="form-control @error('t_secondary') is-invalid @enderror" 
                                       name="t_secondary" id="t_secondary"
                                       value="{{ old('t_secondary', $feeder->t_secondary) }}">
                                @error('t_secondary')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label for="t_daya" class="form-label">T. Daya (kVA)</label>
                                <input type="number" step="0.01" class="form-control @error('t_daya') is-invalid @enderror" 
                                       name="t_daya" id="t_daya"
                                       value="{{ old('t_daya', $feeder->t_daya) }}">
                                @error('t_daya')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        {{-- BARIS 4: kms & mvcell --}}
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="kms" class="form-label">KMS (km)</label>
                                <input type="number" step="0.01" class="form-control @error('kms') is-invalid @enderror" 
                                       name="kms" id="kms"
                                       value="{{ old('kms', $feeder->kms) }}">
                                @error('kms')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label for="mvcell" class="form-label">MVCELL</label>
                                <input type="text" class="form-control @error('mvcell') is-invalid @enderror" 
                                       name="mvcell" id="mvcell"
                                       value="{{ old('mvcell', $feeder->mvcell) }}">
                                @error('mvcell')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        {{-- BARIS 5: pelanggan & kelas --}}
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="pelanggan" class="form-label">Pelanggan</label>
                                <input type="text" class="form-control @error('pelanggan') is-invalid @enderror" 
                                       name="pelanggan" id="pelanggan"
                                       value="{{ old('pelanggan', $feeder->pelanggan) }}">
                                @error('pelanggan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label for="kelas" class="form-label">Kelas</label>
                                <input type="text" class="form-control @error('kelas') is-invalid @enderror" 
                                       name="kelas" id="kelas"
                                       value="{{ old('kelas', $feeder->kelas) }}">
                                @error('kelas')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        {{-- BARIS 6: l/r & inom --}}
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="l_r" class="form-label">L/R</label>
                                {{-- Menggunakan array access untuk kolom dengan karakter '/' --}}
                                <input type="text" class="form-control @error('l/r') is-invalid @enderror" 
                                       name="l/r" id="l_r"
                                       value="{{ old('l/r', $feeder->{'l/r'} ?? '') }}">
                                @error('l/r')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label for="inom" class="form-label">INOM (A)</label>
                                <input type="number" step="0.01" class="form-control @error('inom') is-invalid @enderror" 
                                       name="inom" id="inom"
                                       value="{{ old('inom', $feeder->inom) }}">
                                @error('inom')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        {{-- BARIS 7: iset & up3 --}}
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="iset" class="form-label">ISET (A)</label>
                                <input type="number" step="0.01" class="form-control @error('iset') is-invalid @enderror" 
                                       name="iset" id="iset"
                                       value="{{ old('iset', $feeder->iset) }}">
                                @error('iset')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label for="up3" class="form-label">UP3</label>
                                <input type="text" class="form-control @error('up3') is-invalid @enderror" 
                                       name="up3" id="up3"
                                       value="{{ old('up3', $feeder->up3) }}">
                                @error('up3')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        {{-- BARIS 8: name (Sisa satu field) --}}
                        <div class="row mb-4">
                             <div class="col-md-6">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                       name="name" id="name"
                                       value="{{ old('name', $feeder->name) }}">
                                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                {{-- Kolom kosong untuk menjaga keseimbangan layout --}}
                            </div>
                        </div>


                        <div class="d-flex justify-content-end">
                            <a href="{{ route('bebanpenyulang') ?? url('/feeder') }}" class="btn btn-secondary me-2">Batal</a>
                            <button type="submit" class="btn btn-warning">Simpan Perubahan</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>

        {{-- KOLOM SISI KANAN (4) UNTUK GAMBAR --}}
        <div class="col-md-4">
            <div class="card mt-3">
                <div class="card-body">
                    {{-- Sesuaikan path gambar jika berbeda --}}
                    <img src="{{ asset('img/Edit.png') }}" alt="edit" style="width: 100%; height:100%">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        // Tempat untuk script JS khusus halaman ini
    </script>
@endpush