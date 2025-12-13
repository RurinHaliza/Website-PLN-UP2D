@extends('layouts.app')

@section('title', 'Data Scada Fail')

@push('style')
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Monitoring Scada Fail</h1>
            </div>
        </section>

        <div class="card mt-3">
            <div class="card-header">
                <h5 class="m-0 font-weight-bold text-primary">Tabel Pengukuran</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="table-scada-fail" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Feeder Pkey</th>
                                <th>Gardu</th>
                                <th>Feeder</th>
                                <th>Jam Tanggal</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                    </table>
                </div>
            </div>
            <div class="card-footer">
                <a href="{{ route('download.excel.adminGI') }}" class="btn btn-primary"><i
                        class="fas fa-fw fa-arrow-down"></i>Download Excel</a>
            </div>
        </div>

    </div>

    <div class="modal fade" id="viewBebanModal" tabindex="-1" aria-labelledby="viewBebanModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewBebanModalLabel">View Scada Fail</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Feeder Pkey: <span id="feederp"></span></p>
                    <p>Gardu Induk: <span id="gardu_induk"></span></p>
                    <p>Feeder: <span id="feeder"></span></p>
                    <p>Jam Tanggal: <span id="tanggal"></span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).on('click', '.btn-view-beban', function() {
            var garduInduk = $(this).data('gardu-induk');
            var feeder = $(this).data('feeder');
            var tanggal = $(this).data('tanggal');
            var feeder_pkey = $(this).data('pkey');

            // Populate modal fields
            $('#feederp').text(feeder_pkey);
            $('#gardu_induk').text(garduInduk);
            $('#feeder').text(feeder);
            $('#tanggal').text(tanggal);
        });
    </script>

    <script>
        $("#table-1").dataTable({
            "columnDefs": [{
                "sortable": false,
                "targets": [2, 3]
            }]
        });
    </script>
    
    <script>
        let tableScadaFail = $('#table-scada-fail').DataTable({
            processing: true,
            serverSide: true,
            scrollX: false,
            responsive: true,
            autoWidth: false,
            ajax: {
                url: function() {
                    @if (Auth::user()->hasRole('Administrator'))
                        return "{{ route('scadafail.datatable') }}";
                    @elseif (Auth::user()->hasRole('operator'))
                        return "{{ route('scadafail.datatable.operator') }}";
                    @endif
                }(),
                data: function(d) {
                    var selectedDate = $('#filterHarian').val();

                    d.tanggal = selectedDate;
                    console.log('Tanggal yang dikirim:', d.tanggal);
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
                    data: 'feeder_pkey',
                    name: 'feeder_pkey',
                },
                {
                    data: 'gardu_induk',
                    name: 'gardu_induk',
                },
                {
                    data: 'feeder',
                    name: 'feeder',
                },
                {
                    data: 'tanggal',
                    name: 'tanggal',
                },
                {
                    data: 'status',
                    name: 'status',
                },
                {
                    data: 'action',
                    name: 'action',
                },
            ]
        });
    </script>
@endpush
