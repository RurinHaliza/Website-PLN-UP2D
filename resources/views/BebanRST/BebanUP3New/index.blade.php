@extends('layouts.app')

@section('title', 'Beban UP3 New')

@push('style')
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('library/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.min.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/rowgroup/1.1.0/css/rowGroup.dataTables.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/stylestabel.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Detail Beban UP3 New</h1>
            </div>
        </section>
        <a href="{{ url()->previous() }}" class="btn btn-danger mb-4">Kembali</a>

        {{-- 🔍 Filter Tambahan (Jenis Feeder, Feeder, Name, dan Range Tanggal) --}}
        <div class="card">
            <div class="card-header">
                <form id="filterAdvanced" method="GET" action="{{ route('admin.bebanUp3New.filter') }}">
                    <div class="filter-form">
                        <h4 class="section-title">
                            <span class="filter-status active"></span>
                            Filter Data Beban
                        </h4>
                        <div class="filter-row">
                            <!-- Jenis Feeder -->
                            <div class="filter-group" data-tooltip="Pilih jenis feeder">
                                <label class="required-field">Jenis Feeder</label>
                                <select id="jenisFeeder" name="jenisFeeder" class="filter-control select-control" required>
                                    <option value="">-- Pilih Jenis Feeder --</option>
                                    <option value="penyulang" {{ request('jenisFeeder') == 'penyulang' ? 'selected' : '' }}>
                                        Penyulang</option>
                                    <option value="incoming" {{ request('jenisFeeder') == 'incoming' ? 'selected' : '' }}>
                                        Incoming
                                    </option>
                                </select>
                            </div>

                            <!-- Feeder (multiselect) -->
                            <div class="filter-group">
                                <label class="required-field">Feeder</label>
                                <div class="dropdown multi-checkbox-dropdown w-100 feeder-compact">
                                    <button class="filter-control dropdown-toggle w-100 text-left" type="button"
                                        data-toggle="dropdown">
                                        Pilih Feeder
                                    </button>

                                    <div class="dropdown-menu p-2 w-100 feeder-dropdown"
                                        style="max-height: 300px; overflow-y: auto;">

                                        <!-- Search Box -->
                                        <input type="text" id="searchFeeder" class="form-control mb-2 feeder-search"
                                            placeholder="Cari feeder...">

                                        <!-- Select All -->
                                        <div class="custom-control custom-checkbox select-all-container">
                                            <input type="checkbox" class="custom-control-input" id="selectAllFeeder">
                                            <label class="custom-control-label font-weight-bold" for="selectAllFeeder">
                                                Pilih Semua
                                            </label>
                                        </div>

                                        <hr class="my-2">

                                        <!-- List Feeder Checkbox -->
                                        <div id="feederCheckboxList" class="feeder-list"></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Name -->
                            <div class="filter-group">
                                <label class="required-field">Name</label>
                                <select id="nameSelect" name="name" class="filter-control select-control" required>
                                    <option value="">-- Pilih Name --</option>
                                    <option value="IR">IR</option>
                                    <option value="IS">IS</option>
                                    <option value="IT">IT</option>
                                </select>
                            </div>
                            <!-- Range tanggal -->
                            <div class="col-md-4">
                                <label class="required-field" style="color: white">Range Tanggal</label>
                                <div class="d-flex gap-2">
                                    <input type="date" name="tanggal_awal" class="filter-control" required>
                                    <div class="date-connector">→</div>
                                    <input type="date" name="tanggal_akhir" class="filter-control" required>
                                </div>
                            </div>
                            <div class="mt-3 text-end">
                                <button type="submit" id="showDataAll" class="btn btn-primary"
                                    style="box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);"><i class="fas fa-search"></i>
                                    Tampilkan
                                    Data</button>
                                <a href="{{ route('data.bebanup3new') }}" class="btn btn-secondary"
                                    style="box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">Reset</a>
                            </div>
                            <button type="button" id="exportExcelAll" class="btn btn-success">
                                <i class="fas fa-file-excel"></i> Export Excel
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-body">
                <div class="spinner-overlay-all">
                    <div class="spinner"></div>
                </div>
                <table id="tabelBebanAll" class="display nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th>Up3</th>
                            <th>Gardu Induk</th>
                            <th>Feeder</th>
                            <th>Name</th>
                            <th>Tanggal</th>
                            @for($i = 0; $i < 24; $i++)
                                @for($j = 0; $j < 60; $j += 15)
                                    @if(!($i == 0 && $j == 0))
                                        <th>{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}:{{ str_pad($j, 2, '0', STR_PAD_LEFT) }}</th>
                                    @endif
                                    @if($i == 23 && $j == 45)
                                        <th>23:59</th>
                                    @endif
                                @endfor
                            @endfor
                        </tr>
                    </thead>
                    <tbody id="tbodyBebanAll"></tbody>
                </table>
            </div>
        </div>

        {{-- Form Filter Harian--}}
        <div class="card">
            <div class="card-header">
                <form id="filterHarian" method="GET" action="">
                    <div class="filter-form">
                        <h4 class="section-title">
                            <span class="filter-status active"></span>
                            Beban Harian
                        </h4>
                        <div class="filter-row">
                            <div class="filter-group" data-tooltip="Pilih jenis feeder">
                                <label class="required-field">Feeder</label>
                                <select name="feeder" class="filter-control select-control" required>
                                    <option value="">-- Pilih Feeder --</option>
                                    <option value="Incoming" {{ request('feeder') == 'Incoming' ? 'selected' : '' }}>Incoming
                                    </option>
                                    <option value="Non Incoming" {{ request('feeder') == 'Non Incoming' ? 'selected' : '' }}>
                                        Penyulang</option>
                                </select>
                            </div>

                            <div class="filter-group" data-tooltip="Pilih nama beban">
                                <label class="required-field">Name</label>
                                <select name="name" class="filter-control select-control" required>
                                    <option value="">-- Pilih Name --</option>
                                    <option value="IR" {{ request('name') == 'IR' ? 'selected' : '' }}>IR</option>
                                    <option value="IS" {{ request('name') == 'IS' ? 'selected' : '' }}>IS</option>
                                    <option value="IT" {{ request('name') == 'IT' ? 'selected' : '' }}>IT</option>
                                </select>
                            </div>

                            <div class="filter-group" data-tooltip="Pilih tanggal data">
                                <label class="required-field">Tanggal</label>
                                <input type="date" name="tanggal" value="{{ request('tanggal') }}" class="filter-control"
                                    required>
                            </div>

                            {{-- <div class="filter-group">
                                <label>&nbsp;</label>
                                <button type="button" id="exportExcelHarian" class="export-btn">
                                    <i class="fas fa-file-excel"></i> Export Excel
                                </button>
                            </div> --}}
                        </div>
                    </div>
                </form>
            </div>
            {{-- Tabel Data Beban Listrik --}}
            <div class="card-body">
                <div class="spinner-overlay-harian">
                    <div class="spinner"></div>
                </div>
                <table id="tabelBeban" class="display nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th>Up3</th>
                            <th>Gardu Induk</th>
                            <th>Feeder</th>
                            <th>Name</th>
                            <th>Tanggal</th>
                            @for($i = 0; $i < 24; $i++)
                                @for($j = 0; $j < 60; $j += 15)
                                    @if(!($i == 0 && $j == 0))
                                        <th>{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}:{{ str_pad($j, 2, '0', STR_PAD_LEFT) }}</th>
                                    @endif
                                    @if($i == 23 && $j == 45)
                                        <th>23:59</th>
                                    @endif
                                @endfor
                            @endfor
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>

        {{-- Form Filter Mingguan--}}
        <div class="card">
            <div class="card-header">
                <form id="filterMingguan" method="GET" action="">
                    <div class="filter-form">
                        <h4 class="section-title">
                            <span class="filter-status active"></span>
                            Beban Mingguan
                        </h4>
                        <div class="filter-row">
                            <div class="filter-group" data-tooltip="Pilih jenis feeder">
                                <label class="required-field">Feeder</label>
                                <select name="feeder" class="filter-control select-control" required>
                                    <option value="">-- Pilih Feeder --</option>
                                    <option value="Incoming" {{ request('feeder') == 'Incoming' ? 'selected' : '' }}>Incoming
                                    </option>
                                    <option value="Non Incoming" {{ request('feeder') == 'Non Incoming' ? 'selected' : '' }}>
                                        Penyulang</option>
                                </select>
                            </div>

                            <div class="filter-group" data-tooltip="Pilih nama beban">
                                <label class="required-field">Name</label>
                                <select name="name" class="filter-control select-control" required>
                                    <option value="">-- Pilih Name --</option>
                                    <option value="IR" {{ request('name') == 'IR' ? 'selected' : '' }}>IR</option>
                                    <option value="IS" {{ request('name') == 'IS' ? 'selected' : '' }}>IS</option>
                                    <option value="IT" {{ request('name') == 'IT' ? 'selected' : '' }}>IT</option>
                                </select>
                            </div>

                            <div class="date-range-group">
                                <div class="filter-group date-range-item" data-tooltip="Pilih tanggal mulai">
                                    <label class="required-field">Tanggal Mulai</label>
                                    <input type="date" id="tanggal-mulai" name="tanggal-mulai"
                                        value="{{ request('tanggal-mulai') }}" class="filter-control" required>
                                </div>

                                <div class="date-connector">→</div>

                                <div class="filter-group date-range-item"
                                    data-tooltip="Pilih tanggal akhir (maksimal 7 hari)">
                                    <label class="required-field">Tanggal Akhir</label>
                                    <input type="date" id="tanggal-akhir" name="tanggal-akhir"
                                        value="{{ request('tanggal-akhir') }}" class="filter-control" required>
                                </div>

                                <script>
                                    const startDate = document.getElementById("tanggal-mulai");
                                    const endDate = document.getElementById("tanggal-akhir");

                                    startDate.addEventListener("change", function () {
                                        if (this.value) {
                                            const start = new Date(this.value);
                                            const maxEnd = new Date(start);
                                            maxEnd.setDate(start.getDate() + 6);

                                            const formattedMax = maxEnd.toISOString().split('T')[0];

                                            endDate.min = this.value;
                                            endDate.max = formattedMax;

                                            if (endDate.value > formattedMax || endDate.value < this.value) {
                                                endDate.value = formattedMax;
                                            }
                                        }
                                    });
                                </script>
                            </div>

                            {{-- <div class="filter-group">
                                <label>&nbsp;</label>
                                <button type="button" id="exportExcelMingguan" class="export-btn">
                                    <i class="fas fa-file-excel"></i> Export Excel
                                </button>
                            </div> --}}
                        </div>
                    </div>
                </form>
            </div>

            {{-- Tabel Data Beban Mingguan --}}
            <div class="card-body">
                <div class="spinner-overlay-mingguan">
                    <div class="spinner"></div>
                </div>
                <table id="tabelBebanMingguan" class="display nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th>Up3</th>
                            <th>Gardu Induk</th>
                            <th>Feeder</th>
                            <th>Name</th>
                            <th>Tanggal</th>
                            @for($i = 0; $i < 24; $i++)
                                @for($j = 0; $j < 60; $j += 15)
                                    @if(!($i == 0 && $j == 0))
                                        <th>{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}:{{ str_pad($j, 2, '0', STR_PAD_LEFT) }}</th>
                                    @endif
                                    @if($i == 23 && $j == 45)
                                        <th>23:59</th>
                                    @endif
                                @endfor
                            @endfor
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>

        {{-- Form Filter Bulanan--}}
        <div class="card">
            <div class="card-header">
                <form id="filterBulanan" method="GET" action="">
                    <div class="filter-form">
                        <h4 class="section-title">
                            <span class="filter-status active"></span>
                            Beban Bulanan
                        </h4>
                        <div class="filter-row">
                            <div class="filter-group" data-tooltip="Pilih jenis feeder">
                                <label class="required-field">Feeder</label>
                                <select name="feeder" class="filter-control select-control" required>
                                    <option value="">-- Pilih Feeder --</option>
                                    <option value="Incoming" {{ request('feeder') == 'Incoming' ? 'selected' : '' }}>Incoming
                                    </option>
                                    <option value="Non Incoming" {{ request('feeder') == 'Non Incoming' ? 'selected' : '' }}>
                                        Penyulang</option>
                                </select>
                            </div>

                            <div class="filter-group" data-tooltip="Pilih nama beban">
                                <label class="required-field">Name</label>
                                <select name="name" class="filter-control select-control" required>
                                    <option value="">-- Pilih Name --</option>
                                    <option value="IR" {{ request('name') == 'IR' ? 'selected' : '' }}>IR</option>
                                    <option value="IS" {{ request('name') == 'IS' ? 'selected' : '' }}>IS</option>
                                    <option value="IT" {{ request('name') == 'IT' ? 'selected' : '' }}>IT</option>
                                </select>
                            </div>

                            <div class="filter-group" data-tooltip="Pilih bulan dan tahun">
                                <label class="required-field">Pilih Bulan</label>
                                <input type="month" id="filterBulan" name="filterBulan" class="filter-control"
                                    value="{{ request('filterBulan') }}">
                            </div>

                            <div class="filter-group">
                                <label>&nbsp;</label>
                                <button type="button" id="exportBulanan" class="export-btn">
                                    <i class="fas fa-file-excel"></i> Export Excel
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Tabel Data Beban Listrik -->
            <div class="card-body">
                <div class="spinner-overlay-bulanan">
                    <div class="spinner"></div>
                </div>
                <table id="tabelBebanBulanan" class="display nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th>Up3</th>
                            <th>Gardu Induk</th>
                            <th>Feeder</th>
                            <th>Name</th>
                            <th>Tanggal</th>
                            @for($i = 0; $i < 24; $i++)
                                @for($j = 0; $j < 60; $j += 15)
                                    @if(!($i == 0 && $j == 0))
                                        <th>{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}:{{ str_pad($j, 2, '0', STR_PAD_LEFT) }}</th>
                                    @endif
                                    @if($i == 23 && $j == 45)
                                        <th>23:59</th>
                                    @endif
                                @endfor
                            @endfor
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>


    </div>
@endsection

@push('scripts')
    {{--
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            let table = $('#tabelBeban').DataTable({
                scrollX: true,
                searching: true,
                paging: true,
                info: false,
                columns: [
                    { data: 'up3' },
                    { data: 'gardu_induk' },
                    { data: 'feeder' },
                    { data: 'name' },
                    { data: 'tanggal' },
                    // Kolom dinamis waktu (sesuai 00_15, 00_30, dst)
                    @for($i = 0; $i< 24; $i++)
            @for ($j = 0; $j < 60; $j += 15)
                @if (!($i == 0 && $j == 0)) { data: '{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}_{{ str_pad($j, 2, '0', STR_PAD_LEFT) }}' },
            @endif
            @if ($i == 23 && $j == 45) { data: '23_59' },
            @endif
            @endfor
            @endfor
                                                                                                                                                                                                         ],

            columnDefs: [
                {
                    // indeks mulai dari 0, jadi kolom angka ada di mulai dari index ke-5
                    targets: Array.from({ length: 96 }, (_, i) => i + 5),
                    render: function (data, type, row) {
                        if (data === null || data === undefined) return '';
                        return parseFloat(data).toLocaleString('id-ID', {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2
                        });
                    }
                }
            ]
        });

        let tableMingguan = $('#tabelBebanMingguan').DataTable({
            scrollX: true,
            searching: true,
            paging: true,
            info: false,
            data: [], // supaya bisa diisi manual
            columns: [
                { data: 'up3' },
                { data: 'gardu_induk' },
                { data: 'feeder' },
                { data: 'name' },
                { data: 'tanggal' },
                @for($i = 0; $i< 24; $i++)
        @for ($j = 0; $j < 60; $j += 15)
            @if (!($i == 0 && $j == 0)) { data: '{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}_{{ str_pad($j, 2, '0', STR_PAD_LEFT) }}' },
        @endif
        @if ($i == 23 && $j == 45) { data: '23_59' },
        @endif
        @endfor
        @endfor
                                                                                                                                                                                                        ],

        columnDefs: [
            {
                // indeks mulai dari 0, jadi kolom angka ada di mulai dari index ke-5
                targets: Array.from({ length: 96 }, (_, i) => i + 5),
                render: function (data, type, row) {
                    if (data === null || data === undefined) return '';
                    return parseFloat(data).toLocaleString('id-ID', {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    });
                }
            }
        ]
                                                                                                                                                                    });


        let tableMingguanV2 = $('#tabelBebanMingguanV2').DataTable({
            scrollX: true,
            searching: true,
            paging: true,
            info: false,
            data: [],
            columns: [
                { data: 'up3' },
                { data: 'gardu_induk' },
                { data: 'feeder' },
                { data: 'name' }
                // Kolom tanggal akan ditambahkan dinamis
            ]
        });

        let tableBulanan = $('#tabelBebanBulanan').DataTable({
            scrollX: true,
            searching: true,
            paging: true,
            info: false,
            data: [], // supaya bisa diisi manual
            columns: [
                { data: 'up3' },
                { data: 'gardu_induk' },
                { data: 'feeder' },
                { data: 'name' },
                { data: 'tanggal' },
                @for($i = 0; $i< 24; $i++)
        @for ($j = 0; $j < 60; $j += 15)
            @if (!($i == 0 && $j == 0)) { data: '{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}_{{ str_pad($j, 2, '0', STR_PAD_LEFT) }}' },
        @endif
        @if ($i == 23 && $j == 45) { data: '23_59' },
        @endif
        @endfor
        @endfor
                                                                                                                                                                                                        ],

        columnDefs: [
            {
                // indeks mulai dari 0, jadi kolom angka ada di mulai dari index ke-5
                targets: Array.from({ length: 96 }, (_, i) => i + 5),
                render: function (data, type, row) {
                    if (data === null || data === undefined) return '';
                    return parseFloat(data).toLocaleString('id-ID', {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    });
                }
            }
        ]
                                                                                                                                                                    });

        initFilterEnhancements();
        initDateRangeValidation();
        initExportButtons();

        // Event harian ketika filter berubah → load data AJAX
        $('#filterHarian').on('change', 'select,input[type="date"]', function (e) {
            e.preventDefault();

            let feeder = $('select[name="feeder"]').val();
            let name = $('select[name="name"]').val();
            let tanggal = $('input[name="tanggal"]').val();

            if (feeder && name && tanggal) {
                $.ajax({
                    url: "{{ route('beban.data') }}",
                    method: "GET",
                    data: {
                        feeder: feeder,
                        name: name,
                        tanggal: tanggal
                    },
                    beforeSend: function () {
                        $(".spinner-overlay-harian").show();
                    },
                    success: function (response) {
                        table.clear().rows.add(response).draw();
                    },
                    error: function (xhr) {
                        console.error(xhr.responseText);
                    },
                    complete: function () {
                        $(".spinner-overlay-harian").hide();
                    }
                });
            }
        });

        $('#filterMingguan').on('change', 'select,input[type="date"]', function (e) {
            e.preventDefault();

            let feeder = $('#filterMingguan select[name="feeder"]').val();
            let name = $('#filterMingguan select[name="name"]').val();
            let tanggalMulai = $('#filterMingguan input[name="tanggal-mulai"]').val();
            let tanggalAkhir = $('#filterMingguan input[name="tanggal-akhir"]').val();


            if (feeder && name && tanggalMulai && tanggalAkhir) {
                $.ajax({
                    url: "{{ route('beban.data.mingguan') }}",
                    method: "GET",
                    data: {
                        feeder: feeder,
                        name: name,
                        'tanggal-mulai': tanggalMulai,
                        'tanggal-akhir': tanggalAkhir
                    },
                    beforeSend: function () {
                        $(".spinner-overlay-mingguan").show();
                    },
                    success: function (response) {
                        console.log("Response Mingguan:", response);
                        tableMingguan.clear().rows.add(response.data ?? response).draw();
                    },
                    error: function (xhr) {
                        console.error(xhr.responseText);
                    },
                    complete: function () {
                        $(".spinner-overlay-mingguan").hide();
                    }
                });
            }
        });


        $('#filterBulanan').on('change', 'select,input[type="month"]', function (e) {
            e.preventDefault();

            let feeder = $('#filterBulanan select[name="feeder"]').val();
            let name = $('#filterBulanan select[name="name"]').val();
            let filterBulan = $('#filterBulanan input[name="filterBulan"]').val(); // input type="month"

            if (feeder && name && filterBulan) {
                $.ajax({
                    url: "{{ route('beban.data.bulanan') }}",
                    method: "GET",
                    data: {
                        feeder: feeder,
                        name: name,
                        filterBulan: filterBulan
                    },
                    beforeSend: function () {
                        $(".spinner-overlay-bulanan").show();
                    },
                    success: function (response) {
                        console.log("Response Bulanan:", response);
                        tableBulanan.clear().rows.add(response.data ?? response).draw();
                    },
                    error: function (xhr) {
                        console.error(xhr.responseText);
                    },
                    complete: function () {
                        $(".spinner-overlay-bulanan").hide();
                    }
                });
            }
        });

        // Event tombol Export Excel
        $('#exportExcelHarian').on('click', function () {
            let feeder = $('select[name="feeder"]').val();
            let name = $('select[name="name"]').val();
            let tanggal = $('input[name="tanggal"]').val();

            if (feeder && name && tanggal) {
                // Redirect ke route export dengan parameter filter
                window.location.href = `/beban/export?feeder=${feeder}&name=${name}&tanggal=${tanggal}`;
            } else {
                alert('Silakan pilih Feeder, Name, dan Tanggal terlebih dahulu.');
            }
        });

        $('#exportExcelMingguan').on('click', function () {
            let feeder = $('#filterMingguan select[name="feeder"]').val();
            let name = $('#filterMingguan select[name="name"]').val();
            let tanggalMulai = $('#filterMingguan input[name="tanggal-mulai"]').val();
            let tanggalAkhir = $('#filterMingguan input[name="tanggal-akhir"]').val();

            if (feeder && name && tanggalMulai && tanggalAkhir) {
                window.location.href = `/beban/export/mingguan?feeder=${feeder}&name=${name}&tanggal-mulai=${tanggalMulai}&tanggal-akhir=${tanggalAkhir}`;
            } else {
                alert('Silakan pilih Feeder, Name, Tanggal Mulai, dan Tanggal Akhir terlebih dahulu.');
            }
        });

        $('#exportBulanan').on('click', function (e) {
            e.preventDefault();

            let feeder = $('#filterBulanan select[name="feeder"]').val();
            let name = $('#filterBulanan select[name="name"]').val();
            let filterBulan = $('#filterBulanan input[name="filterBulan"]').val();

            if (!feeder || !name || !filterBulan) {
                alert('Silakan lengkapi semua filter terlebih dahulu.');
                return;
            }

            // Arahkan ke route export bulanan
            let url = "{{ route('beban.export.bulanan') }}" +
                `?feeder=${feeder}&name=${name}&filterBulan=${filterBulan}`;

            window.open(url, '_blank'); // buka di tab baru agar langsung download
        });

        function initFilterEnhancements() {
            // Add loading states to all filters
            $('.filter-control').on('change', function () {
                const $this = $(this);
                const $group = $this.closest('.filter-group');

                // Add loading state
                $group.addClass('filter-loading');

                // Remove loading state after processing
                setTimeout(() => {
                    $group.removeClass('filter-loading');
                    $this.addClass('filter-applied');

                    // Remove success state after 2 seconds
                    setTimeout(() => {
                        $this.removeClass('filter-applied');
                    }, 2000);
                }, 500);
            });

            // Add tooltip data to all filter groups
            $('.filter-group').each(function () {
                const $select = $(this).find('select');
                const $input = $(this).find('input');

                if ($select.length && $select.val()) {
                    const selectedText = $select.find('option:selected').text();
                    $(this).attr('data-tooltip', Selected: ${ selectedText });
                } else if ($input.length && $input.val()) {
                    $(this).attr('data-tooltip', Value: ${ $input.val() });
                }
            });

            // Update tooltip on change for all selects
            $('select.filter-control').on('change', function () {
                const $group = $(this).closest('.filter-group');
                const selectedText = $(this).find('option:selected').text();
                $group.attr('data-tooltip', Selected: ${ selectedText });
            });

            // Update tooltip on change for all inputs
            $('input.filter-control').on('change', function () {
                const $group = $(this).closest('.filter-group');
                $group.attr('data-tooltip', Value: ${ $(this).val() });
            });
        }

        function initDateRangeValidation() {
            // Date range validation for mingguan
            $('#tanggal-mulai, #tanggal-akhir').on('change', function () {
                const startDate = new Date($('#tanggal-mulai').val());
                const endDate = new Date($('#tanggal-akhir').val());

                if (startDate && endDate && startDate > endDate) {
                    $('#tanggal-akhir').addClass('error-state');
                    showNotification('Tanggal akhir tidak boleh sebelum tanggal mulai', 'error');
                } else {
                    $('#tanggal-akhir').removeClass('error-state');
                }

                // Validate max 7 days range
                if (startDate && endDate) {
                    const diffTime = Math.abs(endDate - startDate);
                    const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

                    if (diffDays > 6) {
                        $('#tanggal-akhir').addClass('error-state');
                        showNotification('Rentang tanggal maksimal 7 hari', 'warning');
                    }
                }
            });

            // Month validation for bulanan
            $('#filterBulan').on('change', function () {
                const selectedDate = new Date($(this).val());
                const currentDate = new Date();

                if (selectedDate > currentDate) {
                    $(this).addClass('error-state');
                    showNotification('Tidak bisa memilih bulan di masa depan', 'error');
                } else {
                    $(this).removeClass('error-state');
                }
            });
        }

        function initExportButtons() {
            // Enhanced export buttons for all sections
            $('.export-btn').on('click', function () {
                const $btn = $(this);
                const originalText = $btn.html();
                const section = $btn.closest('.card-header').find('.section-title').text().trim();

                $btn.html('<i class="fas fa-spinner fa-spin"></i> Generating...');
                $btn.prop('disabled', true);

                // Simulate export process
                setTimeout(() => {
                    $btn.html(originalText);
                    $btn.prop('disabled', false);
                    showNotification(File Excel ${ section } berhasil di - generate!, 'success');
                }, 1500);
            });
        }

        // Notification function
        function showNotification(message, type) {
            // Remove existing notifications
            $('.notification').remove();

            const icon = type === 'success' ? 'check-circle' :
                type === 'error' ? 'exclamation-circle' : 'exclamation-triangle';

            const notification = $(`
                                                                                                                                                                            <div class="notification ${type}">
                                                                                                                                                                                <i class="fas fa-${icon}"></i>
                                                                                                                                                                                ${message}
                                                                                                                                                                            </div>
                                                                                                                                                                        `);

            $('body').append(notification);

            setTimeout(() => {
                notification.addClass('show');
            }, 100);

            setTimeout(() => {
                notification.removeClass('show');
                setTimeout(() => notification.remove(), 300);
            }, 4000);
        }

        // Add CSS for notifications and error states
        $('head').append(`
                                                                                                                                                                        <style>
                                                                                                                                                                            .notification {
                                                                                                                                                                                position: fixed;
                                                                                                                                                                                top: 20px;
                                                                                                                                                                                right: 20px;
                                                                                                                                                                                padding: 15px 20px;
                                                                                                                                                                                border-radius: 8px;
                                                                                                                                                                                color: white;
                                                                                                                                                                                font-weight: 500;
                                                                                                                                                                                z-index: 10000;
                                                                                                                                                                                transform: translateX(100%);
                                                                                                                                                                                transition: transform 0.3s ease;
                                                                                                                                                                                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
                                                                                                                                                                                display: flex;
                                                                                                                                                                                align-items: center;
                                                                                                                                                                                gap: 10px;
                                                                                                                                                                                max-width: 400px;
                                                                                                                                                                            }

                                                                                                                                                                            .notification.show {
                                                                                                                                                                                transform: translateX(0);
                                                                                                                                                                            }

                                                                                                                                                                            .notification.success {
                                                                                                                                                                                background: linear-gradient(135deg, #28a745, #20c997);
                                                                                                                                                                            }

                                                                                                                                                                            .notification.error {
                                                                                                                                                                                background: linear-gradient(135deg, #dc3545, #e83e8c);
                                                                                                                                                                            }

                                                                                                                                                                            .notification.warning {
                                                                                                                                                                                background: linear-gradient(135deg, #ffc107, #fd7e14);
                                                                                                                                                                            }

                                                                                                                                                                            .error-state {
                                                                                                                                                                                border: 2px solid #dc3545 !important;
                                                                                                                                                                                background: linear-gradient(90deg, #fff5f5, white) !important;
                                                                                                                                                                            }

                                                                                                                                                                            @keyframes spin {
                                                                                                                                                                                0% { transform: rotate(0deg); }
                                                                                                                                                                                100% { transform: rotate(360deg); }
                                                                                                                                                                            }
                                                                                                                                                                        </style>
                                                                                                                                                                    `);


                                                                                                                                                                });
    </script> --}}

    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function () {

            function generateTimeColumns() {
                let times = [];
                for (let i = 0; i < 24; i++) {
                    for (let j = 0; j < 60; j += 15) {
                        if (!(i === 0 && j === 0)) {
                            let hh = String(i).padStart(2, "0");
                            let mm = String(j).padStart(2, "0");
                            times.push({ data: `${hh}_${mm}` });
                        }
                        if (i === 23 && j === 45) {
                            times.push({ data: "23_59" });
                        }
                    }
                }
                return times;
            }

            const baseColumns = [
                { data: 'up3' },
                { data: 'gardu_induk' },
                { data: 'feeder' },
                { data: 'name' },
                { data: 'tanggal' }
            ];

            const numericRender = {
                targets: Array.from({ length: 96 }, (_, i) => i + 5),
                render: (data) => data ? parseFloat(data).toLocaleString('id-ID', { minimumFractionDigits: 2, maximumFractionDigits: 2 }) : ''
            };

            const tables = {
                harian: $('#tabelBeban').DataTable({
                    scrollX: true,
                    searching: true,
                    paging: true,
                    info: false,
                    columns: [...baseColumns, ...generateTimeColumns()],
                    columnDefs: [numericRender]
                }),
                mingguan: $('#tabelBebanMingguan').DataTable({
                    scrollX: true,
                    searching: true,
                    paging: true,
                    info: false,
                    data: [],
                    columns: [...baseColumns, ...generateTimeColumns()],
                    columnDefs: [numericRender]
                }),
                bulanan: $('#tabelBebanBulanan').DataTable({
                    scrollX: true,
                    searching: true,
                    paging: true,
                    info: false,
                    data: [],
                    columns: [...baseColumns, ...generateTimeColumns()],
                    columnDefs: [numericRender]
                }),
                All: $('#tabelBebanAll').DataTable({
                    scrollX: true,
                    searching: true,
                    paging: true,
                    info: false,
                    columns: [...baseColumns, ...generateTimeColumns()],
                    columnDefs: [numericRender]
                })
            };

            function loadData(type, url, filters, spinnerClass) {
                if (!Object.values(filters).every(v => v)) return;

                $(spinnerClass).show();

                $.get(url, filters)
                    .done(res => tables[type].clear().rows.add(res.data ?? res).draw())
                    .fail(err => console.error(err))
                    .always(() => $(spinnerClass).hide());

            }
            
            function updateButtonLabel() {
                const checked = $('#feederCheckboxList input:checked').length;
                const btn = $('.multi-checkbox-dropdown button');

                btn.text(checked === 0 ? 'Pilih Feeder' : `${checked} feeder dipilih`);
            }

            $("#filterHarian").on("change", "select,input", () => {
                loadData(
                    "harian",
                    "{{ route('beban.data') }}",
                    {
                        feeder: $("#filterHarian select[name='feeder']").val(),
                        name: $("#filterHarian select[name='name']").val(),
                        tanggal: $("#filterHarian input[name='tanggal']").val(),

                    },
                    ".spinner-overlay-harian"
                );
            });


            $("#filterMingguan").on("change", "select,input", () => {
                loadData(
                    "mingguan",
                    "{{ route('beban.data.mingguan') }}",
                    {
                        feeder: $("#filterMingguan select[name='feeder']").val(),
                        name: $("#filterMingguan select[name='name']").val(),
                        'tanggal-mulai': $("#filterMingguan input[name='tanggal-mulai']").val(),
                        'tanggal-akhir': $("#filterMingguan input[name='tanggal-akhir']").val()
                    },
                    ".spinner-overlay-mingguan"
                );
            });

            $("#filterBulanan").on("change", "select,input", () => {
                loadData(
                    "bulanan",
                    "{{ route('beban.data.bulanan') }}",
                    {
                        feeder: $("#filterBulanan select[name='feeder']").val(),
                        name: $("#filterBulanan select[name='name']").val(),
                        filterBulan: $("#filterBulanan input[name='filterBulan']").val()
                    },
                    ".spinner-overlay-bulanan"
                );
            });

            // Select All checkbox
            $(document).on('change', '#selectAllFeeder', function () {
                const checked = $(this).prop('checked');
                $('#feederCheckboxList input[type="checkbox"]').prop('checked', checked);
                updateButtonLabel();
            });

            // Keep dropdown open when clicking inside
            $('.multi-checkbox-dropdown .dropdown-menu').on('click', function (e) {
                e.stopPropagation();
            });


            // Individual checkbox change listener
            $(document).on('change', '#feederCheckboxList input[type="checkbox"]', function () {
                const all = $('#feederCheckboxList input[type="checkbox"]').length;
                const checked = $('#feederCheckboxList input:checked').length;

                $('#selectAllFeeder').prop('checked', all === checked);
                updateButtonLabel();
            });

            // Live Search Filter for Feeder
            $(document).on('keyup', '#searchFeeder', function () {
                const search = $(this).val().toLowerCase();

                $('#feederCheckboxList .custom-control').each(function () {
                    const text = $(this).text().toLowerCase();
                    $(this).toggle(text.includes(search));
                });
            });

            // Load Feeder list based on Jenis
            $('#jenisFeeder').on('change', function () {
                const jenis = $(this).val();
                $('#feederCheckboxList').empty();
                $('#searchFeeder').val('');
                $('#selectAllFeeder').prop('checked', false);
                updateButtonLabel();

                if (jenis) {
                    $.ajax({
                        url: "{{ route('admin.getFeederByJenis') }}",
                        type: "GET",
                        data: { jenis: jenis },
                        success: function (res) {
                            res.forEach(item => {
                                const id = 'feeder_' + item.feeder.replace(/\s+/g, '_');
                                $('#feederCheckboxList').append(`
                                                                                            <div class="custom-control custom-checkbox">
                                                                                                <input type="checkbox" class="custom-control-input feeder-checkbox" id="${id}" value="${item.feeder}">
                                                                                                <label class="custom-control-label" for="${id}">${item.feeder}</label>
                                                                                            </div>
                                                                                        `);
                            });
                        },
                        error: function (err) {
                            console.error(err);
                        }
                    });
                }
            });

            // === Klik tombol Tampilkan Data ===
            $('#showDataAll').on('click', function (e) {
                e.preventDefault();

                // ambil nilai filter
                let jenisFeeder = $('#jenisFeeder').val();

                let feeder;
                if ($('#selectAllFeeder').prop('checked')) {
                    feeder = "ALL";
                } else {
                    feeder = $('#feederCheckboxList input:checked').map(function () {
                        return $(this).val();
                    }).get();
                }

                let name = $('#nameSelect').val();
                let tanggal_awal = $('input[name="tanggal_awal"]').val();
                let tanggal_akhir = $('input[name="tanggal_akhir"]').val();

                // tampilkan spinner
                $('.spinner-overlay-all').show();

                // request AJAX ke route filter
                $.ajax({
                    url: "{{ route('admin.bebanUp3New.filter') }}",
                    type: "GET",
                    data: {
                        jenisFeeder: jenisFeeder,
                        feeder: feeder,
                        name: name,
                        tanggal_awal: tanggal_awal,
                        tanggal_akhir: tanggal_akhir,
                        ajax: 1 // optional flag
                    },
                    success: function (res) {
                        $('.spinner-overlay-all').hide();

                        // pastikan data ada
                        const rows = res.data || [];

                        // replace table data: destroy and re-create DataTable data
                        if ($.fn.DataTable.isDataTable('#tabelBebanAll')) {
                            $('#tabelBebanAll').DataTable().clear().rows.add(rows).draw();
                        } else {
                            // fallback (seharusnya sudah di-init)
                            $('#tabelBebanAll').DataTable({
                                scrollX: true,
                                data: rows,
                                columns: (function () {
                                    const base = [
                                        { title: "Up3", data: "up3" },
                                        { title: "Gardu Induk", data: "gardu_induk" },
                                        { title: "Feeder", data: "feeder" },
                                        { title: "Name", data: "name" },
                                        { title: "Tanggal", data: "tanggal" },
                                    ];
                                    const timeKeys = generateTimeColumnKeys();
                                    const timeCols = timeKeys.map(k => ({ title: k.replace('_', ':'), data: k }));
                                    return base.concat(timeCols);
                                })(),
                                scrollX: true,
                                searching: true,
                                paging: true,
                                info: false
                            });
                        }
                    },
                    error: function (err) {
                        $('.spinner-overlay-all').hide();
                        console.error(err);
                        alert('Gagal mengambil data. Cek console untuk detail.');
                    }
                });
            });

            function exportExcel(baseUrl, params) {
                if (!Object.values(params).every(v => v)) return alert("Lengkapi filter!");
                window.open(`${baseUrl}?${new URLSearchParams(params).toString()}`, "_blank");
            }

            $("#exportExcelHarian").click(() =>
                exportExcel("/beban/export", {
                    feeder: $("select[name='feeder']").val(),
                    name: $("select[name='name']").val(),
                    tanggal: $("input[name='tanggal']").val()
                })
            );

            $("#exportExcelMingguan").click(() =>
                exportExcel("/beban/export/mingguan", {
                    feeder: $("#filterMingguan select[name='feeder']").val(),
                    name: $("#filterMingguan select[name='name']").val(),
                    'tanggal-mulai': $("#filterMingguan input[name='tanggal-mulai']").val(),
                    'tanggal-akhir': $("#filterMingguan input[name='tanggal-akhir']").val()
                })
            );

            $("#exportBulanan").click(() =>
                exportExcel("{{ route('beban.export.bulanan') }}", {
                    feeder: $("#filterBulanan select[name='feeder']").val(),
                    name: $("#filterBulanan select[name='name']").val(),
                    filterBulan: $("#filterBulanan input[name='filterBulan']").val()
                })
            );

            $('#exportExcelAll').on('click', function () {
                let jenisFeeder = $('#jenisFeeder').val();

                let feeder;
                if ($('#selectAllFeeder').prop('checked')) {
                    feeder = "ALL";
                } else {
                    feeder = $('#feederCheckboxList input:checked').map(function () {
                        return $(this).val();
                    }).get();
                }

                let name = $('#nameSelect').val();
                let tanggal_awal = $('input[name="tanggal_awal"]').val();
                let tanggal_akhir = $('input[name="tanggal_akhir"]').val();

                // Buat query string dari filter yang aktif
                let params = $.param({
                    jenisFeeder: jenisFeeder,
                    feeder: feeder,
                    name: name,
                    tanggal_awal: tanggal_awal,
                    tanggal_akhir: tanggal_akhir
                });

                // Redirect untuk trigger download
                window.location.href = "{{ route('admin.bebanUp3New.export') }}?" + params;
            });

        });
    </script>

@endpush