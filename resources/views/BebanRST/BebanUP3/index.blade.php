@extends('layouts.app')

@section('title', 'Beban UP3')

@push('style')
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('library/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.min.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/rowgroup/1.1.0/css/rowGroup.dataTables.min.css">
    <style>
        .card-body {
            overflow-x: auto;
        }
    </style>
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Detail Beban UP3</h1>
            </div>
        </section>
        <a href="{{ url()->previous() }}" class="btn btn-danger mb-4">Kembali</a>
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header"
                        style="background: linear-gradient(to bottom, rgb(58, 94, 255), rgb(99, 182, 255) 100%) !important; ">
                        <h4 style="color:white">Beban Penyulang Tertinggi Hari ini</h4>
                    </div>
                    <div class="card-body">
                        <ul>
                            <li>Ampere: <span id="ampereValue">-</span></li>
                            <li>Tanggal: <span id="tanggalValue">-</span></li>
                            <li>Pukul: <span id="waktuValue">-</span>
                            <li>UP3: <span id="up3Value">-</span></li>
                            <li>Gardu Induk: <span id="garduIndukValue">-</span></li>
                            <li>Feeder: <span id="feederValue">-</span></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header"
                        style="background: linear-gradient(to bottom, rgb(58, 94, 255), rgb(99, 182, 255) 100%) !important; ">
                        <h4 style="color:white">Beban Penyulang Tertinggi Minggu ini</h4>
                    </div>
                    <div class="card-body">
                        <ul>
                            <li>Ampere: <span id="ampereValueMingguan">-</span></li>
                            <li>Tanggal: <span id="tanggalValueMingguan">-</span></li>
                            <li>Pukul: <span id="waktuValueMingguan">-</span>
                            <li>UP3: <span id="up3ValueMingguan">-</span></li>
                            <li>Gardu Induk: <span id="garduIndukValueMingguan">-</span></li>
                            <li>Feeder: <span id="feederValueMingguan">-</span></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header"
                        style="background: linear-gradient(to bottom, rgb(58, 94, 255), rgb(99, 182, 255) 100%) !important; ">
                        <h4 style="color:white">Beban Penyulang Tertinggi Bulan ini</h4>
                    </div>
                    <div class="card-body">
                        <ul>
                            <li>Ampere: <span id="ampereValueBulanan">-</span></li>
                            <li>Tanggal: <span id="tanggalValueBulanan">-</span></li>
                            <li>Pukul: <span id="waktuValueBulanan">-</span>
                            <li>UP3: <span id="up3ValueBulanan">-</span></li>
                            <li>Gardu Induk: <span id="garduIndukValueBulanan">-</span></li>
                            <li>Feeder: <span id="feederValueBulanan">-</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"
                        style="background: linear-gradient(to bottom, rgb(58, 94, 255), rgb(99, 182, 255) 100%) !important; ">
                        <div class="row">
                            <h4 style="color:white">Beban harian</h4>
                        </div>
                        <div class="col-md-4">
                            <label for="filterHarian" style="color:white">Pilih hari</label>
                            <input type="date" name="filterHarian" id="filterHarian" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label for="filterUP3" style="color:white">Pilih UP3</label>
                            <select name="filterUP3" id="filterUP3" class="form-control">
                                <option value="" disabled selected>Pilih Kategori</option>
                                @foreach (config('wilayah.UP3') as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table" id="tabelbebanHarianUP3">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>UP3 / Gardu induk</th>
                                    <th>Feeder</th>
                                    @foreach (config('wilayah.jam') as $key => $value)
                                        <th>{{ $value }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header"
                        style="background: linear-gradient(to bottom, rgb(58, 94, 255), rgb(99, 182, 255) 100%) !important;">
                        <div class="text-center mb-3 mr-5">
                            <h4 style="color:white;">Beban Mingguan</h4>
                        </div>
                        <div class="row">
                            <div class="d-flex justify-content-center align-items-center">
                                <div class="me-3">
                                    <label for="filterAwalBulan" style="color:white; display: block;">Pilih Tanggal
                                        Mulai</label>
                                    <input type="date" name="filterAwalBulan" id="filterAwalBulan" class="form-control">
                                </div>
                                <div class="ml-3">
                                    <label for="filterAkhirBulan" style="color:white; display: block;">Pilih Tanggal
                                        Akhir</label>
                                    <input type="date" name="filterAkhirBulan" id="filterAkhirBulan"
                                        class="form-control">
                                </div>
                                <div class="ml-3">
                                    <label for="filterKategori" style="color:white">Pilih UP3</label>
                                    <select name="filterKategori" id="filterKategori" class="form-control">
                                        <option value="" disabled selected>Pilih Kategori</option>
                                        @foreach (config('wilayah.UP3') as $key => $value)
                                            <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table" id="tabelbebanMingguanUP3">
                            <thead>
                                <tr>
                                    <th>UP3</th>
                                    <th>Gardu induk</th>
                                    <th>Incoming</th>
                                    <th>Name</th>
                                    @foreach (config('wilayah.jam') as $key => $value)
                                        <th>{{ $value }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header"
                        style="background: linear-gradient(to bottom, rgb(58, 94, 255), rgb(99, 182, 255) 100%) !important; ">
                        <div class="text-center mb-3 mr-5">
                            <h4 style="color:white">Beban Bulanan</h4>
                        </div>
                        <div class="row">
                            <div class="d-flex justify-content-center align-items-center">
                                <div class="me-3">
                                    <label for="filterAwalBulan" style="color:white; display: block;">Pilih Bulan</label>
                                    <input type="month" name="filterBulanan" id="filterBulanan" class="form-control">
                                </div>
                                <div class="ml-3">
                                    <label for="filterUP3Bulanan" style="color:white">Pilih UP3</label>
                                    <select name="filterUP3Bulanan" id="filterUP3Bulanan" class="form-control">
                                        <option value="" disabled selected>Pilih Kategori</option>
                                        @foreach (config('wilayah.UP3') as $key => $value)
                                            <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table" id="tabelbebanBulananUP3">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Bulan</th>
                                    <th>Gardu induk</th>
                                    <th>Incoming</th>
                                    <th>Name</th>
                                    @foreach (config('wilayah.jam') as $key => $value)
                                        <th>{{ $key }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <canvas id="bebanChart2"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('library/chart.js/dist/Chart.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/rowgroup/1.1.0/js/dataTables.rowGroup.min.js"></script>

    <script src="https://cdn.datatables.net/buttons/2.1.0/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.html5.min.js"></script>

    <script>
        let tableDataHarian = $('#tabelbebanHarianUP3').DataTable({
            processing: true,
            serverSide: true,
            scrollX: false,
            responsive: true,
            autoWidth: false,
            dom: 'Bfrtip',
            buttons: [{
                extend: 'excelHtml5',
                text: '<i class="fa fa-file-excel-o"></i> Export Excel',
                titleAttr: 'Export to Excel',
                title: function() {
                    const tanggal = $('#filterHarian').val() || 'Semua Tanggal';
                    const up3 = $('#filterUP3').val() || 'Semua UP3';
                    return `Laporan Beban Harian - ${tanggal} - ${up3}`;
                },
                exportOptions: {
                    rows: function(idx, data, node) {
                        return true;
                    },
                    columns: ':visible'
                }
            }],
            ajax: {
                url: "{{ route('dataHarian.up3') }}",
                data: function(d) {
                    var selectedDate = $('#filterHarian').val();
                    var selectedUP3 = $('#filterUP3').val();

                    d.tanggal = selectedDate;
                    d.up3 = selectedUP3;

                    console.log('UP3 :', d.up3);

                    return d;
                },
                type: 'GET',
                beforeSend: function() {
                    Swal.fire({
                        title: 'Loading...',
                        text: 'Mohon tunggu sebentar, sedang mengambil data.',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading()
                        }
                    });
                },
                complete: function() {
                    Swal.close();
                },
                error: function(xhr, error, thrown) {
                    console.log('Error:', error);
                    console.log('XHR:', xhr.responseText);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Terjadi kesalahan saat mengambil data'
                    });
                }
            },
            deferRender: true,
            oLanguage: {
                sProcessing: '<div class="d-flex justify-content-center"><div class="dots-bars-4 mt-2"></div></div>',
                sEmptyTable: '<div class="dm-empty text-center"><div class="dm-empty__image"><img src="{{ url('/hexadash/img/svg/1.png') }}" alt="Admin Empty"></div><div class="dm-empty__text"><p class="">Tidak Ada Data</p></div></div>',
                sInfoEmpty: "Tidak ada entri data yang didapat",
                sZeroRecords: '<div class="dm-empty text-center"><div class="dm-empty__image"><img src="{{ url('/hexadash/img/svg/1.png') }}" alt="Admin Empty"></div><div class="dm-empty__text"><p class="">Tidak Ada Data</p></div></div>',
                sInfo: "Menampilkan entri ke-_START_ s/d _END_ dari total _TOTAL_ entri",
                sSearch: "Cari:      ",
                oPaginate: {
                    "sPrevious": '<i class="fa fa-angle-double-left" aria-hidden="true"></i>',
                    "sNext": '<i class="fa fa-angle-double-right" aria-hidden="true"></i>'
                }
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'up3_gi',
                    name: 'up3_gi',
                },
                {
                    data: 'feeder',
                    name: 'feeder',
                },
                {
                    data: '00_30',
                    name: '00_30',
                },
                {
                    data: '01_00',
                    name: '01_00',
                },
                {
                    data: '01_30',
                    name: '01_30',
                },
                {
                    data: '02_00',
                    name: '02_00',
                },
                {
                    data: '02_30',
                    name: '02_30',
                },
                {
                    data: '03_00',
                    name: '03_00',
                },
                {
                    data: '03_30',
                    name: '03_30',
                },
                {
                    data: '04_00',
                    name: '04_00',
                },
                {
                    data: '04_30',
                    name: '04_30',
                },
                {
                    data: '05_00',
                    name: '05_00',
                },
                {
                    data: '05_30',
                    name: '05_30',
                },

                {
                    data: '06_00',
                    name: '06_00',
                }, {
                    data: '06_30',
                    name: '06_30',
                }, {
                    data: '07_00',
                    name: '07_00',
                },
                {
                    data: '07_30',
                    name: '07_30',
                },
                {
                    data: '08_00',
                    name: '08_00',
                },
                {
                    data: '08_30',
                    name: '08_30',
                },
                {
                    data: '09_00',
                    name: '09_00',
                },
                {
                    data: '09_30',
                    name: '09_30',
                },
                {
                    data: '10_00',
                    name: '10_00',
                },
                {
                    data: '10_30',
                    name: '10_30',
                },
                {
                    data: '11_00',
                    name: '11_00',
                },
                {
                    data: '11_30',
                    name: '11_30',
                },
                {
                    data: '12_00',
                    name: '12_00',
                },
                {
                    data: '12_30',
                    name: '12_30',
                }, {
                    data: '13_00',
                    name: '13_00',
                },
                {
                    data: '13_30',
                    name: '13_30',
                }, {
                    data: '14_00',
                    name: '14_00',
                },
                {
                    data: '14_30',
                    name: '14_30',
                },
                {
                    data: '15_00',
                    name: '15_00',
                },
                {
                    data: '15_30',
                    name: '15_30',
                },
                {
                    data: '16_00',
                    name: '16_00',
                },
                {
                    data: '16_30',
                    name: '16_30',
                },
                {
                    data: '17_00',
                    name: '17_00',
                },
                {
                    data: '17_30',
                    name: '17_30',
                },
                {
                    data: '18_00',
                    name: '18_00',
                },
                {
                    data: '18_30',
                    name: '18_30',
                },
                {
                    data: '19_00',
                    name: '19_00',
                },
                {
                    data: '19_30',
                    name: '19_30',
                },
                {
                    data: '20_00',
                    name: '20_00',
                },
                {
                    data: '20_30',
                    name: '20_30',
                },
                {
                    data: '21_00',
                    name: '21_00',
                },
                {
                    data: '21_30',
                    name: '21_30',
                },
                {
                    data: '22_00',
                    name: '22_00',
                },
                {
                    data: '22_30',
                    name: '22_30',
                },
                {
                    data: '23_00',
                    name: '23_00',
                },
                {
                    data: '23_30',
                    name: '23_30',
                },
            ]
        });

        $('#filterHarian, #filterUP3').on('change', function() {
            tableDataHarian.ajax.reload();

            const tanggal = $('#filterHarian').val();
            const up3 = $('#filterUP3').val();

            $.ajax({
                url: '{{ route('card.beban.perhari') }}',
                method: 'GET',
                data: {
                    tanggal: tanggal,
                    up3: up3
                },
                success: function(response) {
                    if (response && response.length > 0) {
                        renderCard(response); // Assuming the response itself is the array
                        console.log(response);

                    } else {
                        renderCard([]); // Pass empty array if no data
                    }
                },
                error: function() {
                    alert('Terjadi kesalahan dalam memuat data.');
                }
            });

            function renderCard(data) {
                if (data.length > 0) {
                    $('#ampereValue').text(data[0].beban_tertinggi);
                    $('#tanggalValue').text(data[0].tanggal);
                    $('#waktuValue').text(data[0].waktu_beban_tertinggi);
                    $('#up3Value').text(data[0].up3);
                    $('#garduIndukValue').text(data[0].gardu_induk);
                    $('#feederValue').text(data[0].feeder);
                } else {
                    // Mengatur nilai default jika tidak ada data
                    $('#ampereValue').text('-');
                    $('#tanggalValue').text('-');
                    $('#waktuValue').text('-');
                    $('#up3Value').text('-');
                    $('#garduIndukValue').text('-');
                    $('#feederValue').text('-');
                }
            }

        });
    </script>

    <script>
        let tableDataMingguan = $('#tabelbebanMingguanUP3').DataTable({
            processing: true,
            serverSide: true,
            scrollX: false,
            responsive: true,
            autoWidth: false,
            ajax: {
                url: "{{ route('dataMingguan.up3') }}",
                data: function(d) {
                    var selectedDateAwal = $('#filterAwalBulan').val();
                    var selectedDateAkhir = $('#filterAkhirBulan').val();
                    var selectedUP3 = $('#filterKategori').val();

                    d.tanggal_awal = selectedDateAwal;
                    d.tanggal_akhir = selectedDateAkhir;
                    d.up3 = selectedUP3;

                    console.log('Tanggal awal:', d.tanggal_awal);
                    console.log('Tanggal akhir:', d.tanggal_akhir);
                    console.log('UP3:', d.up3);

                    return d;
                },
                type: 'GET',
                beforeSend: function() {
                    Swal.fire({
                        title: 'Loading...',
                        text: 'Mohon tunggu sebentar, sedang mengambil data.',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading()
                        }
                    });
                },
                complete: function() {
                    Swal.close();
                },
                error: function(xhr, error, thrown) {
                    console.log('Error:', error);
                    console.log('XHR:', xhr.responseText);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Terjadi kesalahan saat mengambil data'
                    });
                }
            },
            deferRender: true,
            oLanguage: {
                sProcessing: '<div class="d-flex justify-content-center"><div class="dots-bars-4 mt-2"></div></div>',
                sEmptyTable: '<div class="dm-empty text-center"><div class="dm-empty__image"><img src="{{ url('/hexadash/img/svg/1.png') }}" alt="Admin Empty"></div><div class="dm-empty__text"><p class="">Tidak Ada Data</p></div></div>',
                sInfoEmpty: "Tidak ada entri data yang didapat",
                sZeroRecords: '<div class="dm-empty text-center"><div class="dm-empty__image"><img src="{{ url('/hexadash/img/svg/1.png') }}" alt="Admin Empty"></div><div class="dm-empty__text"><p class="">Tidak Ada Data</p></div></div>',
                sInfo: "Menampilkan entri ke-_START_ s/d _END_ dari total _TOTAL_ entri",
                sSearch: "Cari:      ",
                oPaginate: {
                    "sPrevious": '<i class="fa fa-angle-double-left" aria-hidden="true"></i>',
                    "sNext": '<i class="fa fa-angle-double-right" aria-hidden="true"></i>'
                }
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'up3_gi',
                    name: 'up3_gi',
                },
                {
                    data: 'feeder',
                    name: 'feeder',
                },
                {
                    data: '00_30',
                    name: '00_30',
                },
                {
                    data: '01_00',
                    name: '01_00',
                },
                {
                    data: '01_30',
                    name: '01_30',
                },
                {
                    data: '02_00',
                    name: '02_00',
                },
                {
                    data: '02_30',
                    name: '02_30',
                },
                {
                    data: '03_00',
                    name: '03_00',
                },
                {
                    data: '03_30',
                    name: '03_30',
                },
                {
                    data: '04_00',
                    name: '04_00',
                },
                {
                    data: '04_30',
                    name: '04_30',
                },
                {
                    data: '05_00',
                    name: '05_00',
                },
                {
                    data: '05_30',
                    name: '05_30',
                },

                {
                    data: '06_00',
                    name: '06_00',
                }, {
                    data: '06_30',
                    name: '06_30',
                }, {
                    data: '07_00',
                    name: '07_00',
                },
                {
                    data: '07_30',
                    name: '07_30',
                },
                {
                    data: '08_00',
                    name: '08_00',
                },
                {
                    data: '08_30',
                    name: '08_30',
                },
                {
                    data: '09_00',
                    name: '09_00',
                },
                {
                    data: '09_30',
                    name: '09_30',
                },
                {
                    data: '10_00',
                    name: '10_00',
                },
                {
                    data: '10_30',
                    name: '10_30',
                },
                {
                    data: '11_00',
                    name: '11_00',
                },
                {
                    data: '11_30',
                    name: '11_30',
                },
                {
                    data: '12_00',
                    name: '12_00',
                },
                {
                    data: '12_30',
                    name: '12_30',
                }, {
                    data: '13_00',
                    name: '13_00',
                },
                {
                    data: '13_30',
                    name: '13_30',
                }, {
                    data: '14_00',
                    name: '14_00',
                },
                {
                    data: '14_30',
                    name: '14_30',
                },
                {
                    data: '15_00',
                    name: '15_00',
                },
                {
                    data: '15_30',
                    name: '15_30',
                },
                {
                    data: '16_00',
                    name: '16_00',
                },
                {
                    data: '16_30',
                    name: '16_30',
                },
                {
                    data: '17_00',
                    name: '17_00',
                },
                {
                    data: '17_30',
                    name: '17_30',
                },
                {
                    data: '18_00',
                    name: '18_00',
                },
                {
                    data: '18_30',
                    name: '18_30',
                },
                {
                    data: '19_00',
                    name: '19_00',
                },
                {
                    data: '19_30',
                    name: '19_30',
                },
                {
                    data: '20_00',
                    name: '20_00',
                },
                {
                    data: '20_30',
                    name: '20_30',
                },
                {
                    data: '21_00',
                    name: '21_00',
                },
                {
                    data: '21_30',
                    name: '21_30',
                },
                {
                    data: '22_00',
                    name: '22_00',
                },
                {
                    data: '22_30',
                    name: '22_30',
                },
                {
                    data: '23_00',
                    name: '23_00',
                },
                {
                    data: '23_30',
                    name: '23_30',
                },
            ]
        });

        $('#filterAwalBulan, #filterAkhirBulan, #filterKategori').on('change', function() {
            // Validasi tanggal
            var tglAwal = $('#filterAwalBulan').val();
            var tglAkhir = $('#filterAkhirBulan').val();

            if (tglAwal && tglAkhir && new Date(tglAwal) > new Date(tglAkhir)) {
                Swal.fire({
                    icon: 'error',
                    title: 'Kesalahan',
                    text: 'Tanggal awal tidak boleh lebih besar dari tanggal akhir!'
                });
                return false;
            }

            // Reload tabel
            tableDataMingguan.ajax.reload();

            var selectedDateAwal = $('#filterAwalBulan').val();
            var selectedDateAkhir = $('#filterAkhirBulan').val();
            var selectedUP3 = $('#filterKategori').val();

            $.ajax({
                url: '{{ route('card.beban.mingguan') }}',
                method: 'GET',
                data: {
                    tanggal_awal: selectedDateAwal,
                    tanggal_akhir: selectedDateAkhir,
                },
                success: function(response) {
                    if (response && response.length > 0) {
                        renderCard(response);
                        console.log(response);

                    } else {
                        renderCard([]);
                    }
                },
                error: function() {
                    alert('Terjadi kesalahan dalam memuat data.');
                }
            });

            function renderCard(data) {
                if (data.length > 0) {
                    $('#ampereValueMingguan').text(data[0].beban_tertinggi);
                    $('#tanggalValueMingguan').text(data[0].tanggal);
                    $('#waktuValueMingguan').text(data[0].waktu_beban_tertinggi);
                    $('#up3ValueMingguan').text(data[0].up3);
                    $('#garduIndukValueMingguan').text(data[0].gardu_induk);
                    $('#feederValueMingguan').text(data[0].feeder);
                } else {
                    $('#ampereValueMingguan').text('-');
                    $('#tanggalValueMingguan').text('-');
                    $('#waktuValueMingguan').text('-');
                    $('#up3ValueMingguan').text('-');
                    $('#garduIndukValueMingguan').text('-');
                    $('#feederValueMingguan').text('-');
                }
            }



        });
    </script>

    <script>
        let tableDataBulanan = $('#tabelbebanBulananUP3').DataTable({
            processing: true,
            serverSide: true,
            scrollX: false,
            responsive: true,
            autoWidth: false,
            ajax: {
                url: "{{ route('dataBulanan.up3') }}",
                data: function(d) {
                    d.filterBulanan = $('#filterBulanan').val();
                    d.filterKategori = $('#filterUP3Bulanan').val();

                    console.log('Filters up3:', d.filterKategori);

                    return d;
                },
                type: 'GET',
                beforeSend: function() {
                    Swal.fire({
                        title: 'Loading...',
                        text: 'Mohon tunggu sebentar, sedang mengambil data.',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading()
                        }
                    });
                },
                complete: function() {
                    Swal.close();
                },
                error: function(xhr, error, thrown) {
                    console.log('Error:', error);
                    console.log('XHR:', xhr.responseText);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Terjadi kesalahan saat mengambil data'
                    });
                }
            },
            deferRender: true,
            oLanguage: {
                sProcessing: '<div class="d-flex justify-content-center"><div class="dots-bars-4 mt-2"></div></div>',
                sEmptyTable: '<div class="dm-empty text-center"><div class="dm-empty__image"><img src="{{ url('/hexadash/img/svg/1.png') }}" alt="Admin Empty"></div><div class="dm-empty__text"><p class="">Tidak Ada Data</p></div></div>',
                sInfoEmpty: "Tidak ada entri data yang didapat",
                sZeroRecords: '<div class="dm-empty text-center"><div class="dm-empty__image"><img src="{{ url('/hexadash/img/svg/1.png') }}" alt="Admin Empty"></div><div class="dm-empty__text"><p class="">Tidak Ada Data</p></div></div>',
                sInfo: "Menampilkan entri ke-_START_ s/d _END_ dari total _TOTAL_ entri",
                sSearch: "Cari:      ",
                oPaginate: {
                    "sPrevious": '<i class="fa fa-angle-double-left" aria-hidden="true"></i>',
                    "sNext": '<i class="fa fa-angle-double-right" aria-hidden="true"></i>'
                }
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'up3_gi',
                    name: 'up3_gi',
                },
                {
                    data: 'feeder',
                    name: 'feeder',
                },
                {
                    data: '00_30',
                    name: '00_30',
                },
                {
                    data: '01_00',
                    name: '01_00',
                },
                {
                    data: '01_30',
                    name: '01_30',
                },
                {
                    data: '02_00',
                    name: '02_00',
                },
                {
                    data: '02_30',
                    name: '02_30',
                },
                {
                    data: '03_00',
                    name: '03_00',
                },
                {
                    data: '03_30',
                    name: '03_30',
                },
                {
                    data: '04_00',
                    name: '04_00',
                },
                {
                    data: '04_30',
                    name: '04_30',
                },
                {
                    data: '05_00',
                    name: '05_00',
                },
                {
                    data: '05_30',
                    name: '05_30',
                },

                {
                    data: '06_00',
                    name: '06_00',
                }, {
                    data: '06_30',
                    name: '06_30',
                }, {
                    data: '07_00',
                    name: '07_00',
                },
                {
                    data: '07_30',
                    name: '07_30',
                },
                {
                    data: '08_00',
                    name: '08_00',
                },
                {
                    data: '08_30',
                    name: '08_30',
                },
                {
                    data: '09_00',
                    name: '09_00',
                },
                {
                    data: '09_30',
                    name: '09_30',
                },
                {
                    data: '10_00',
                    name: '10_00',
                },
                {
                    data: '10_30',
                    name: '10_30',
                },
                {
                    data: '11_00',
                    name: '11_00',
                },
                {
                    data: '11_30',
                    name: '11_30',
                },
                {
                    data: '12_00',
                    name: '12_00',
                },
                {
                    data: '12_30',
                    name: '12_30',
                }, {
                    data: '13_00',
                    name: '13_00',
                },
                {
                    data: '13_30',
                    name: '13_30',
                }, {
                    data: '14_00',
                    name: '14_00',
                },
                {
                    data: '14_30',
                    name: '14_30',
                },
                {
                    data: '15_00',
                    name: '15_00',
                },
                {
                    data: '15_30',
                    name: '15_30',
                },
                {
                    data: '16_00',
                    name: '16_00',
                },
                {
                    data: '16_30',
                    name: '16_30',
                },
                {
                    data: '17_00',
                    name: '17_00',
                },
                {
                    data: '17_30',
                    name: '17_30',
                },
                {
                    data: '18_00',
                    name: '18_00',
                },
                {
                    data: '18_30',
                    name: '18_30',
                },
                {
                    data: '19_00',
                    name: '19_00',
                },
                {
                    data: '19_30',
                    name: '19_30',
                },
                {
                    data: '20_00',
                    name: '20_00',
                },
                {
                    data: '20_30',
                    name: '20_30',
                },
                {
                    data: '21_00',
                    name: '21_00',
                },
                {
                    data: '21_30',
                    name: '21_30',
                },
                {
                    data: '22_00',
                    name: '22_00',
                },
                {
                    data: '22_30',
                    name: '22_30',
                },
                {
                    data: '23_00',
                    name: '23_00',
                },
                {
                    data: '23_30',
                    name: '23_30',
                },
            ]
        });

        $('#filterBulanan, #filterUP3Bulanan').on('change', function() {
            tableDataBulanan.ajax.reload();

            const tanggal = $('#filterBulanan').val();
            const up3 = $('#filterUP3Bulanan').val();

            $.ajax({
                url: '{{ route('card.beban.perbulan') }}',
                method: 'GET',
                data: {
                    filterBulanan: tanggal,
                    up3: up3
                },
                success: function(response) {
                    if (response && response.length > 0) {
                        renderCard(response);
                        console.log(response);

                    } else {
                        renderCard([]);
                    }
                },
                error: function() {
                    alert('Terjadi kesalahan dalam memuat data.');
                }
            });

            function renderCard(data) {
                if (data.length > 0) {
                    $('#ampereValueBulanan').text(data[0].beban_tertinggi);
                    $('#tanggalValueBulanan').text(data[0].tanggal);
                    $('#waktuValueBulanan').text(data[0].waktu_beban_tertinggi);
                    $('#up3ValueBulanan').text(data[0].up3);
                    $('#garduIndukValueBulanan').text(data[0].gardu_induk);
                    $('#feederValueBulanan').text(data[0].feeder);
                } else {
                    // Mengatur nilai default jika tidak ada data
                    $('#ampereValueBulanan').text('-');
                    $('#tanggalValueBulanan').text('-');
                    $('#waktuValueBulanan').text('-');
                    $('#up3ValueBulanan').text('-');
                    $('#garduIndukValueBulanan').text('-');
                    $('#feederValueBulanan').text('-');
                }
            }

        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var ctx = document.getElementById('bebanChart2').getContext('2d');

            function fetchDataAndRenderChart(type, params) {
                const queryString = new URLSearchParams(params).toString();

                fetch(`/getDataChart?type=${type}&${queryString}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.error) {
                            console.error(data.message);
                            return;
                        }

                        // Hapus chart sebelumnya jika ada
                        if (window.bebanChart) {
                            window.bebanChart.destroy();
                        }

                        // Tentukan dataset
                        var datasets = data.datasets.map((dataset, index) => ({
                            label: dataset.label,
                            data: dataset.data,
                            borderColor: getRandomColor(index),
                            backgroundColor: 'rgba(0,0,0,0)',
                            fill: false,
                            tension: 0.1
                        }));

                        // Render chart baru
                        window.bebanChart = new Chart(ctx, {
                            type: 'line',
                            data: {
                                labels: data.labels,
                                datasets: datasets
                            },
                            options: {
                                scales: {
                                    x: {
                                        title: {
                                            display: true,
                                            text: 'Waktu',
                                        }
                                    },
                                    y: {
                                        title: {
                                            display: true,
                                            text: 'Beban',
                                        },
                                        beginAtZero: true
                                    }
                                },
                                plugins: {
                                    legend: {
                                        display: true
                                    }
                                }
                            }
                        });
                    })
                    .catch(err => console.error('Error fetching chart data:', err));
            }

            // Fungsi untuk mendapatkan warna acak
            function getRandomColor(index) {
                const colors = [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ];
                return colors[index % colors.length];
            }

            document.getElementById('filterHarian').addEventListener('change', function() {
                var tanggal = new Date(this.value);
                if (!isNaN(tanggal)) {
                    var formattedDate = tanggal.toISOString().split('T')[0];
                    console.log('Tanggal dikirim ke backend:', formattedDate);
                    fetchDataAndRenderChart('daily', {
                        tanggal: formattedDate
                    });
                }
            });

            document.getElementById('filterAwalBulan').addEventListener('change', function() {
                var startDate = new Date(this.value);
                var endDate = new Date(document.getElementById('filterAkhirBulan').value);

                if (!isNaN(startDate) && !isNaN(endDate)) {
                    var formattedStartDate = startDate.toISOString().split('T')[0];
                    var formattedEndDate = endDate.toISOString().split('T')[0];
                    console.log('Tanggal awal dan akhir dikirim ke backend:', formattedStartDate,
                        formattedEndDate);

                    fetchDataAndRenderChart('weekly', {
                        tanggal_awal: formattedStartDate,
                        tanggal_akhir: formattedEndDate
                    });
                }
            });

            document.getElementById('filterAkhirBulan').addEventListener('change', function() {
                var startDate = new Date(document.getElementById('filterAwalBulan').value);
                var endDate = new Date(this.value);

                if (!isNaN(startDate) && !isNaN(endDate)) {
                    var formattedStartDate = startDate.toISOString().split('T')[0];
                    var formattedEndDate = endDate.toISOString().split('T')[0];
                    console.log('Tanggal awal dan akhir dikirim ke backend:', formattedStartDate,
                        formattedEndDate);

                    fetchDataAndRenderChart('weekly', {
                        tanggal_awal: formattedStartDate,
                        tanggal_akhir: formattedEndDate
                    });
                }
            });

            document.getElementById('filterBulanan').addEventListener('change', function() {
                var bulan = this.value;
                if (bulan) {
                    console.log('Bulan dikirim ke backend:', bulan);
                    fetchDataAndRenderChart('monthly', {
                        tanggal_awal: bulan
                    });
                }
            });

            var initialTanggal = document.getElementById('filterHarian').value;
            if (initialTanggal) {
                var initialDate = new Date(initialTanggal);
                if (!isNaN(initialDate)) {
                    var formattedInitialDate = initialDate.toISOString().split('T')[0];
                    fetchDataAndRenderChart('daily', {
                        tanggal: formattedInitialDate
                    });
                }
            }
        });
    </script>
@endpush
