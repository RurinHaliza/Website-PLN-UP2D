@extends('layouts.app')

@section('title', 'Tambah Penyulang')

@section('main')

    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Tambah Data Penyulang</h1>
            </div>
        </section>

        <a href="{{ url()->previous() }}" class="btn btn-danger mb-3">Kembali</a>


        <div class="row">
            <div class="col-md-8">
                <div class="card mt-3">
                    <div class="card-header">
                        <h5 class="m-0 font-weight-bold text-primary">Data Penyulang</h5>
                    </div>
                    @if (session('error'))
                        <div class="alert alert-danger border-left-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span> {{-- Menggunakan &times; untuk konsistensi --}}
                            </button>
                        </div>
                    @endif

                    <div class="card-body">
                        @php
                        $cleanAndUnique = function ($collection) {
                            return $collection
                                ->filter(function ($value) {
                                    return !empty($value) && $value != '0' && !is_numeric($value);
                                })
                                ->map(function ($value) {
                                    $value = strtoupper($value);
                                    return trim(preg_replace('/\s+/', ' ', str_replace(['-', '_'], ' ', $value)));
                                })
                                ->unique()
                                ->sort()
                                ->filter(function ($value) {
                                    return !empty($value);
                                })
                                ->values();
                        };

                        // 🔹 ULP (gabungan feeder + penyulang)
                        $ulp_penyulang = $penyulangs->pluck('ULP');
                        $ulp_feeder = $feeders->pluck('ulp');
                        $all_ulp_raw = $ulp_penyulang->merge($ulp_feeder);
                        $unique_ulp = $cleanAndUnique($all_ulp_raw);

                        $unique_upt = $cleanAndUnique($dg_mvcell->pluck('UPT'));

                        // Build a lightweight index for frontend consumption: gardu_induk, UPT, ulp
                        $dgIndex = $dg_mvcell->map(function ($d) {
                            // getAttributes() exists on Eloquent models; fallback to array cast
                            $attrs = method_exists($d, 'getAttributes') ? $d->getAttributes() : (is_array($d) ? $d : (array) $d);

                            $find = function ($keys) use ($attrs) {
                                foreach ($keys as $k) {
                                    if (array_key_exists($k, $attrs) && $attrs[$k] !== null && trim((string) $attrs[$k]) !== '') {
                                        return $attrs[$k];
                                    }
                                }
                                return null;
                            };

                            $gardu = $find(['gardu_induk', 'GARDU INDUK', 'GARDU_INDUK', 'GARDU', 'gardu']);
                            $upt = $find(['UPT', 'upt', 'Nama_Penyulang', 'NM_JTM']);
                            $ulp = $find(['ulp', 'ULP', 'Ulp']);

                            return [
                                'gardu_induk' => $gardu,
                                'UPT' => $upt,
                                'ulp' => $ulp,
                            ];
                        })->values()->all();
                        @endphp

                        <form action="{{ route('store.penyulang') }}" method="POST">
                            @csrf

                            {{-- GARDU INDUK - SIMPLE SELECT --}}
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Gardu Induk</label>
                                    <select name="GARDU_INDUK" id="gardu_induk" class="form-control" required>
                                        <option value="">-- Pilih Gardu Induk --</option>
                                        @foreach($unique_gardu_induk as $gi)
                                            <option value="{{ $gi }}" {{ old('GARDU_INDUK') == $gi ? 'selected' : '' }}>{{ $gi }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('GARDU_INDUK')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Nama Singkatan</label>
                                    <input type="text" name="NM_SINGKATAN" class="form-control"
                                        placeholder="Masukkan Nama Singkatan" value="{{ old('NM_SINGKATAN') }}">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Nama Trafo (T_NO)</label>
                                    <input type="text" name="T_NO" id="no_trafo" class="form-control"
                                        placeholder="Masukkan Nama Trafo (T_NO)" value="{{ old('T_NO') }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">UP3</label>
                                    <input type="text" name="UP3" id="up3" class="form-control" placeholder="Masukkan UP3"
                                        value="{{ old('UP3') }}">
                                    @error('UP3') <div class="text-danger">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-6" id="penyulang_container">
                                    <label class="form-label">Nama Penyulang (Kubikel)</label>
                                    <select name="NM_JTM" id="kubikel_select" class="form-control select2">
                                        <option value="">-- Pilih Kubikel Penyulang --</option>
                                        {{-- Akan terisi otomatis melalui AJAX --}}
                                    </select>
                                    @error('NM_JTM') 
                                        <div class="text-danger">{{ $message }}</div> 
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">ULP</label>
                                    <input type="text" name="ULP" id="ulp" class="form-control" placeholder="ULP akan terisi otomatis" value="{{ old('ULP') }}">
                                    @error('ULP') <div class="text-danger">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <label class="form-label">PKEY</label>
                                    @php
                                        $pkeys_vertical = ['IR', 'IS', 'IT', 'P', 'V'];
                                    @endphp

                                    @foreach($pkeys_vertical as $pkey)
                                        <div class="row mb-2 align-items-center">
                                            <div class="col-md-2 d-flex justify-content-end">
                                                <label class="form-label mb-0 me-2">{{ $pkey }}</label>
                                            </div>
                                            <input type="hidden" name="PKEY_NAME_{{ $pkey }}" value="{{ $pkey }}">
                                            <div class="col-md-10">
                                                <input type="text" 
                                                    name="PKEY_VAL_{{ $pkey }}" 
                                                    id="{{ strtolower($pkey) }}" {{-- tambahkan id untuk JS --}}
                                                    class="form-control"
                                                    placeholder="Nilai {{ $pkey }}" 
                                                    value="{{ old('PKEY_VAL_' . $pkey) }}">
                                                @error('PKEY_VAL_' . $pkey) 
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    @endforeach

                                    <div class="mb-3">
                                        <label class="form-label">T_PRIMARY</label>
                                        <input type="text" name="T_PRIMARY" class="form-control"
                                            placeholder="Masukkan T_PRIMARY" value="{{ old('T_PRIMARY') }}">
                                        @error('T_PRIMARY') <div class="text-danger">{{ $message }}</div> @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">T_SECONDARY</label>
                                        <input type="text" name="T_SECONDARY" class="form-control"
                                            placeholder="Masukkan T_SECONDARY" value="{{ old('T_SECONDARY') }}">
                                        @error('T_SECONDARY') <div class="text-danger">{{ $message }}</div> @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">MVCell</label>
                                        <input type="text" name="MVCELL" id="mvcell" class="form-control"
                                            placeholder="Masukkan MVCell" value="{{ old('MVCELL') }}">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">KMS</label>
                                        <input type="text" name="KMS" id="kms" class="form-control" placeholder="Masukkan KMS"
                                            value="{{ old('KMS') }}">
                                    </div>
                                </div>

                                <div class="col-md-6 d-flex flex-column justify-content-start">
                                    <div class="mb-3">
                                        <label class="form-label">T_DAYA</label>
                                        <input type="text" name="T_DAYA" class="form-control"
                                            placeholder="Masukkan T_DAYA" value="{{ old('T_DAYA') }}">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Pelanggan</label>
                                        <input type="text" name="PELANGGAN" id="pelanggan" class="form-control"
                                            placeholder="Masukkan Pelanggan" value="{{ old('PELANGGAN') }}">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Kelas</label>
                                        <input type="text" name="KELAS" class="form-control"
                                            placeholder="Masukkan Kelas secara manual" value="{{ old('KELAS') }}">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">I/R</label>
                                        <input type="text" name="IR_VAL" id="ir" class="form-control"
                                            placeholder="Masukkan I/R" value="{{ old('IR_VAL') }}">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">INOM</label>
                                        <input type="text" name="INOM" class="form-control" placeholder="Masukkan INOM"
                                            value="{{ old('INOM') }}">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">ISET</label>
                                        <input type="text" name="ISET" class="form-control" placeholder="Masukkan ISET"
                                            value="{{ old('ISET') }}">
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end mt-4">
                                <button type="submit" class="btn btn-primary">Simpan Data</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card mt-3">
                    <div class="card-body">
                        <img src="{{ asset('img/Edit.png') }}" alt="Gambar Ilustrasi" style="width:100%; height:100%;">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- TIDAK ADA @push scripts SAMA SEKALI --}}

@push('scripts')
<script>

// ============================================================
// 1. AJAX UNTUK MENGAMBIL DATA KUBIKEL BERDASARKAN GARDU INDUK
// ============================================================
$(document).on('change', '#gardu_induk', function () {
    let gardu = $(this).val();

    if (!gardu) {
        $('#kubikel_select').html('<option value="">-- Pilih Kubikel Penyulang --</option>');
        return;
    }

    $.ajax({
        url: "{{ route('get.kubikel') }}",
        type: "POST",
        data: {
            gardu_induk: gardu,
            _token: '{{ csrf_token() }}'
        },
        success: function (res) {
            $('#kubikel_select').empty();
            $('#kubikel_select').append('<option value="">-- Pilih Kubikel Penyulang --</option>');

            res.forEach(item => {
                $('#kubikel_select').append(
                    <option value="${item.nama_kubikel}">${item.nama_kubikel}</option>
                );
            });
        }
    });
});

$('#kubikel_select').on('change', function() {
    var namaKubikel = $(this).val();

    if (!namaKubikel) {
        $('#no_trafo, #up3, #ulp, #mvcell, #pelanggan, #kms, #ir').val('');
        return;
    }

    $.ajax({
        url: '/get-detail-kubikel/' + encodeURIComponent(namaKubikel),
        method: 'GET',
        success: function(res) {
            $('#no_trafo').val(res.no_trafo || '');
            $('#up3').val(res.up3 || '');
            $('#ulp').val(res.ulp || '');
            $('#mvcell').val(res.mvcell || '');
            $('#pelanggan').val(res.pelanggan || '');
            $('#kms').val(res.kms || '');
            $('#ir').val(res.ir || '');
        },
        error: function() {
            $('#no_trafo, #up3, #ulp, #mvcell, #pelanggan, #kms, #ir').val('');
        }
    });
});

document.addEventListener('DOMContentLoaded', function () {

    // Ambil elemen-elemen dropdown dan input
    const garduIndukSelect = document.getElementById('gardu_induk');
    const penyulangSelect = document.getElementById('penyulang_select');
    const ulpInput = document.getElementById('ulp');
    const trafoGarduIndukSelect = document.getElementById('trafo_gardu_induk');

    // Event ketika gardu induk berubah
    garduIndukSelect.addEventListener('change', function () {
        const garduInduk = this.value;

        if (garduInduk) {
            // Ambil data penyulang berdasarkan gardu induk
            fetch(`/api/penyulangs-by-gardu?gardu_induk=${garduInduk}`)
                .then(response => response.json())
                .then(data => {
                    penyulangSelect.innerHTML = '<option value="">-- Pilih Penyulang --</option>';
                    data.forEach(item => {
                        const option = document.createElement('option');
                        option.value = item.nama_penyulang;
                        option.dataset.ulp = item.ulp; // Simpan data ULP
                        option.textContent = item.nama_penyulang;
                        penyulangSelect.appendChild(option);
                    });
                });

            // Ambil data trafo berdasarkan gardu induk
            fetch(`/api/trafo-by-gardu?gardu_induk=${garduInduk}`)
                .then(response => response.json())
                .then(data => {
                    trafoGarduIndukSelect.innerHTML = '<option value="">-- Pilih Trafo Gardu Induk --</option>';
                    data.forEach(item => {
                        const option = document.createElement('option');
                        option.value = item.trafo_gi;
                        option.textContent = item.trafo_gi;
                        trafoGarduIndukSelect.appendChild(option);
                    });
                });
        } else {
            // Reset jika tidak ada gardu induk yang dipilih
            penyulangSelect.innerHTML = '<option value="">-- Pilih Penyulang --</option>';
            ulpInput.value = '';
            trafoGarduIndukSelect.innerHTML = '<option value="">-- Pilih Trafo Gardu Induk --</option>';
        }
    });

    // Event ketika penyulang berubah
    penyulangSelect.addEventListener('change', function () {
        const selectedOption = this.options[this.selectedIndex];
        const ulp = selectedOption.dataset.ulp; // Dapatkan ULP dari data attribute
        const namaPenyulang = this.value;

        // Isi nilai ULP
        ulpInput.value = ulp || '';

        if (namaPenyulang) {
            // Ambil detail penyulang
            fetch(`/api/penyulang-detail?nama_penyulang=${namaPenyulang}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('keypoint').value = data.keypoint || '';
                });
        } else {
            document.getElementById('keypoint').value = '';
        }
    });
});

</script>
@endpush