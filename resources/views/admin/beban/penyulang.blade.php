@extends('layouts.app')

@section('title', 'General Dashboard')

@push('style')
<!-- CSS Libraries -->
<link rel="stylesheet" href="{{ asset('library/jqvmap/dist/jqvmap.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.min.css') }}">
@endpush

@section('main')

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Beban Penyulang</h1>
        </div>
    </section>

    @if (session('success'))
    <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span> {{-- Menggunakan &times; untuk konsistensi --}}
        </button>
    </div>
    @endif
    @if (session('error'))
    <div class="alert alert-danger border-left-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span> {{-- Menggunakan &times; untuk konsistensi --}}
        </button>
    </div>
    @endif

    <div class="card mt-3">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="m-0 font-weight-bold text-primary">{{ $tableName ?? 'Tabel Data' }}</h5> 
            
            <!-- START: BUTTON TAMBAH TUNGGAL (Sekarang menjadi dinamis) -->
            @php
                $isPenyulang = (isset($current_table) && $current_table === 'penyulang');
                $buttonText = $isPenyulang ? 'Tambah Data' : 'Tambah Data';
                // Asumsi: rute 'create.feeder.admin' tersedia
                $buttonRoute = $isPenyulang ? route('create.penyulang') : route('create.penyulang'); 
            @endphp
            <a 
                href="{{ $buttonRoute }}" 
                class="btn btn-success btn-sm"
                style="border-radius:6px; font-weight:600; display:flex; align-items:center; gap:6px;">
                <i class="fas fa-plus"></i> {{ $buttonText }}
            </a>
            <!-- END: BUTTON TAMBAH TUNGGAL -->
        </div>
        <div class="card-body">

            <!-- START: TABLE SWITCHER & FORM FILTER -->
            <div class="row mb-3 align-items-center">
                
                <!-- Table Switcher Dropdown -->
                <div class="col-md-6 d-flex align-items-center mb-2 mb-md-0">
                    <!-- FORM TABLE SWITCHER: Rute diperbaiki menjadi 'bebanpenyulang' -->
                    <form id="tableForm" action="{{ route('bebanpenyulang') }}" method="GET" class="d-flex align-items-center mr-4">
                        <label for="table" class="mr-2 mb-0 text-sm font-weight-bold">Tabel</label>
                        <select name="table" id="table" class="custom-select custom-select-sm form-control form-control-sm" onchange="document.getElementById('tableForm').submit()">
                            <option value="penyulang" @if(isset($current_table) && $current_table === 'penyulang') selected @endif>Penyulang</option>
                            <option value="feeder" @if(isset($current_table) && $current_table === 'feeder') selected @endif>Feeder (Data Master)</option>
                        </select>
                        <input type="hidden" name="show" value="{{ $current_limit ?? 10 }}">
                        <input type="hidden" name="search" value="{{ $current_search ?? '' }}">
                    </form>

                    <!-- Filter Show Entries -->
                    <!-- FORM LIMIT: Rute diperbaiki menjadi 'bebanpenyulang' -->
                    <form id="limitForm" action="{{ route('bebanpenyulang') }}" method="GET" class="d-flex align-items-center">
                        <label for="show" class="mr-2 mb-0 text-sm font-weight-bold">Show</label>
                        <select name="show" id="show" class="custom-select custom-select-sm form-control form-control-sm" onchange="document.getElementById('limitForm').submit()">
                            @foreach([10, 25, 50, 100] as $option)
                                <option value="{{ $option }}" @if(isset($current_limit) && $current_limit == $option) selected @endif>{{ $option }}</option>
                            @endforeach
                        </select>
                        <span class="ml-2 text-sm font-weight-bold">entries</span>
                        <input type="hidden" name="search" value="{{ $current_search ?? '' }}">
                        <input type="hidden" name="table" value="{{ $current_table ?? 'penyulang' }}">
                    </form>
                </div>
                
                <!-- Search Box -->
                <div class="col-md-6">
                    <!-- FORM SEARCH: Rute diperbaiki menjadi 'bebanpenyulang' -->
                    <form action="{{ route('bebanpenyulang') }}" method="GET" class="float-right form-inline">
                        <label for="search" class="mr-2 mb-0 text-sm font-weight-bold">Search:</label>
                        <input type="search" name="search" id="search" class="form-control form-control-sm" value="{{ $current_search ?? '' }}" placeholder="{{ (isset($current_table) && $current_table === 'penyulang') ? 'NM JTM/Feeder, GI, dll...' : 'Feeder, Gardu Induk, PKEY...' }}">
                        <input type="hidden" name="show" value="{{ $current_limit ?? 10 }}">
                        <input type="hidden" name="table" value="{{ $current_table ?? 'penyulang' }}">
                        
                        <button type="submit" class="btn btn-sm btn-primary ml-2">Cari</button>
                        @if(isset($current_search) && $current_search)
                            <!-- Tombol Reset Search: Rute diperbaiki menjadi 'bebanpenyulang' -->
                            <a href="{{ route('bebanpenyulang', ['show' => $current_limit ?? 10, 'table' => $current_table ?? 'penyulang']) }}" class="btn btn-sm btn-secondary ml-1">Reset</a>
                        @endif
                    </form>
                </div>
            </div>
            <!-- END: TABLE SWITCHER & FORM FILTER -->

            <div class="table-responsive">
                <table class="table table-bordered" id="penyulang_data" cellspacing="0" width="100%">
                    <thead>
                        <!-- HEADER DINAMIS -->
                        @if (isset($current_table) && $current_table === 'penyulang')
                            <tr>
                                <th>ID JTM</th>
                                <th>ID GI</th>
                                <th>ID TRAFO GI</th>
                                <th>NM JTM</th>
                                <th>NM GI</th>
                                <th>NM Singkatan</th>
                                <th>UP3</th>
                                <th>ULP</th>
                                <th>Action</th> {{-- Total 9 Kolom --}}
                            </tr>
                        @else 
                            <!-- Header untuk Tabel DataMasterFeeder -->
                            <tr>
                                <th>ID Master</th>
                                <th>PKEY ID</th>
                                <th>NM Feeder</th>
                                <th>Gardu Induk</th>
                                <th>T No</th>
                                <th>T Primary</th>
                                <th>T Secondary</th>
                                <th>KMS</th>
                                <th>MV Cell</th>
                                <th>Pelanggan</th>
                                <th>Kelas</th>
                                <th>L/R</th> 
                                <th>Inom</th> 
                                <th>Iset</th>
                                <th>UP3</th>
                                <th>Name</th> 
                                <th>Action</th> {{-- Total 17 Kolom --}}
                            </tr>
                        @endif
                    </thead>

                    <tbody>
                        @forelse($penyulang as $p)
                            <!-- BODY DINAMIS -->
                            @if (isset($current_table) && $current_table === 'penyulang')
                                <tr>
                                    <td>{{ $p->ID_JTM }}</td>
                                    <td>{{ $p->ID_GI }}</td>
                                    <td>{{ $p->ID_TRAFOGI }}</td>
                                    <td>{{ $p->NM_JTM }}</td>
                                    <td>{{ $p->NM_GI }}</td>
                                    <td>{{ $p->NM_SINGKATAN }}</td>
                                    <td>{{ $p->UP3 }}</td>
                                    <td>{{ $p->ULP }}</td>
                                    
                                    <td>
                                        <!-- Aksi untuk Penyulang -->
                                        <a href="{{ route('penyulang.detail.admin', $p->id) }}" class="btn btn-primary btn-sm" style="border-radius:6px;">Detail</a>
                                        <a href="{{ route('edit.penyulang.admin', $p->id) }}" class="btn btn-warning btn-sm" style="border-radius:6px;">Edit data</a>
                                        <form action="{{ route('penyulang.delete', $p->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" style="border-radius:6px;">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @else 
                                <!-- Baris untuk Tabel DataMasterFeeder -->
                                <tr>
                                    <td>{{ $p->id }}</td>
                                    <td>{{ $p->feeder_pkey ?? '-' }}</td> 
                                    <td>{{ $p->feeder ?? '-' }}</td>
                                    <td>{{ $p->gardu_induk ?? '-' }}</td>
                                    <td>{{ $p->t_no ?? '-' }}</td>
                                    <td>{{ $p->t_primary ?? '-' }}</td>
                                    <td>{{ $p->t_secondary ?? '-' }}</td>
                                    <td>{{ $p->kms ?? '-' }}</td>
                                    <td>{{ $p->mvcell ?? '-' }}</td>
                                    <td>{{ $p->pelanggan ?? '-' }}</td>
                                    <td>{{ $p->kelas ?? '-' }}</td>
                                    <td>{{ $p->lr ?? '-' }}</td> 
                                    <td>{{ $p->inom ?? '-' }}</td> 
                                    <td>{{ $p->iset ?? '-' }}</td> 
                                    <td>{{ $p->up3 ?? '-' }}</td>
                                    <td>{{ $p->name ?? '-' }}</td> 
                                    <td>
                                        <!-- Aksi untuk Feeder: Detail diperbaiki -->
                                        {{-- Asumsi rute 'feeder.detail.admin' ada --}}
                                        <a href="{{ route('feeder.detail.admin', $p->id) }}" class="btn btn-primary btn-sm" style="border-radius:6px;">Detail</a>

                                        <!-- Tombol Edit (Diasumsikan rute 'feeder.edit.admin') -->
                                        <a href="{{ route('feeder.edit.admin', $p->id) }}" class="btn btn-warning btn-sm" style="border-radius:6px;">Edit data</a>

                                        <!-- Tombol Hapus (Diasumsikan rute 'feeder.delete') -->
                                        <form action="{{ route('feeder.delete', $p->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" style="border-radius:6px;">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endif

                        @empty
                            <tr>
                                {{-- Colspan diperbaiki menjadi 17 untuk Feeder Master --}}
                                <td colspan="{{ (isset($current_table) && $current_table === 'penyulang') ? 9 : 17 }}" class="text-center">
                                    Data {{ (isset($current_table) && $current_table === 'penyulang') ? 'Penyulang' : 'Feeder Master' }} tidak ditemukan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- START: PAGINATION LINKS & INFO -->
            @if ($penyulang instanceof \Illuminate\Contracts\Pagination\LengthAwarePaginator && $penyulang->hasPages())
                <div class="row mt-3">
                    <div class="col-sm-12 col-md-5">
                        <div class="dataTables_info" role="status" aria-live="polite">
                            Showing {{ $penyulang->firstItem() }} to {{ $penyulang->lastItem() }} of {{ $penyulang->total() }} entries
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-7">
                        <div class="dataTables_paginate paging_simple_numbers float-right">
                            <!-- Memastikan parameter 'table' disertakan dalam link pagination -->
                            {{ $penyulang->appends(['table' => $current_table ?? 'penyulang'])->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            @endif
            <!-- END: PAGINATION LINKS & INFO -->
        </div>

        <div class="card-footer">
            @if (isset($current_table) && $current_table === 'penyulang')
            <a href="{{ route('download.excel.adminpenyulang') }}" class="btn btn-primary btn-sm" style="border-radius:6px;">
                <i class="fas fa-fw fa-arrow-down"></i> Download Excel (Penyulang)
            </a>
            @else
            {{-- Asumsi rute download Feeder Master adalah 'download.excel.adminfeeder' --}}
            <a href="{{ route('download.excel.adminfeeder') }}" class="btn btn-primary btn-sm" style="border-radius:6px;">
                <i class="fas fa-fw fa-arrow-down"></i> Download Excel (Feeder)
            </a>
            @endif
        </div>
    </div>
</div>

@endsection

@push('scripts')
<!-- Tidak ada perubahan pada bagian scripts -->
@endpush