@extends('layouts.app')

@section('title', 'Data Approval')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.min.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Approval Scada Fail</h1>
            </div>
        </section>

        <div class="card mt-3">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="approval-scada-fail" cellspacing="0">
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
                <button class="btn btn-primary"><i class="fas fa-fw fa-arrow-down"></i>Download Excel</button>
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
        $("#approval").dataTable({
            "columnDefs": [{
                "sortable": false,
                "targets": [2, 3]
            }]
        });
    </script>

    <script>
        let tableScadaFail = $('#approval-scada-fail').DataTable({
            processing: true,
            serverSide: true,
            scrollX: false,
            responsive: true,
            autoWidth: false,
            ajax: {
                url: function() {
                    @if (Auth::user()->hasRole('Administrator'))
                        return "{{ route('data.approval.datatable') }}";
                    @elseif (Auth::user()->hasRole('ValidatorOpsis'))
                        return "{{ route('data.approval.datatable.opsis') }}";
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

    <script>
        $(document).ready(function() {
            $(document).on('click', '.btn-update-status', function() {
                var id = $(this).data('id');
                var feederPkey = $(this).data('feeder-pkey');
                var incoming = $(this).data('feeder');

                Swal.fire({
                    title: 'Confirm Status Update',
                    text: 'Apakah Anda Yakin untuk mengupdate data ?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, Update Status!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: function() {
                                @if (Auth::user()->hasRole('Administrator'))
                                    return "{{ route('action.approval') }}";
                                @elseif (Auth::user()->hasRole('ValidatorOpsis'))
                                    return "{{ route('action.approval.opsis') }}";
                                @endif
                            }(),

                            method: 'POST',
                            data: {
                                id: id,
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Status Updated!',
                                    text: 'The status has been successfully updated.',
                                    timer: 2000,
                                    showConfirmButton: false
                                }).then(() => {
                                    // Reload the datatable or page
                                    $('#table-scada-fail').DataTable().ajax
                                        .reload();
                                });
                            },
                            error: function(xhr) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error!',
                                    text: 'Failed to update status.',
                                    timer: 3000,
                                    showConfirmButton: false
                                });
                            }
                        });
                    }
                });
            });
        });
    </script>
@endpush
