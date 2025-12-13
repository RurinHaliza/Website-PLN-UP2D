@extends('layouts.app')

@section('title', 'Edit Scada Fail')

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
                <h1>Edit Feeder : {{ $data->gardu_induk }}</h1>
            </div>
        </section>
        <a href="{{ url()->previous() }}" class="btn btn-danger">Kembali</a>

        <div class="row">
            <div class="col-md-8">
                <div class="card mt-3">
                    <div class="card-header">
                        <h5 class="m-0 font-weight-bold text-primary">Detail Rincian Data</h5>
                    </div>
                    <div class="card-body">

                        <form action="" method="POST" id="formScadaFail">
                            @csrf
                            @php
                                $timeSlots = [
                                    '00_30',
                                    '01_00',
                                    '01_30',
                                    '02_00',
                                    '02_30',
                                    '03_00',
                                    '03_30',
                                    '04_00',
                                    '04_30',
                                    '05_00',
                                    '05_30',
                                    '06_00',
                                    '06_30',
                                    '07_00',
                                    '07_30',
                                    '08_00',
                                    '08_30',
                                    '09_00',
                                    '09_30',
                                    '10_00',
                                    '10_30',
                                    '11_00',
                                    '11_30',
                                    '12_00',
                                    '12_30',
                                    '13_00',
                                    '13_30',
                                    '14_00',
                                    '14_30',
                                    '15_00',
                                    '15_30',
                                    '16_00',
                                    '16_30',
                                    '17_00',
                                    '17_30',
                                    '18_00',
                                    '18_30',
                                    '19_00',
                                    '19_30',
                                    '20_00',
                                    '20_30',
                                    '21_00',
                                    '21_30',
                                    '22_00',
                                    '22_30',
                                    '23_00',
                                    '23_30',
                                ];
                            @endphp

                            {{-- {{ dd($data) }} --}}

                            <div class="row">
                                <div class="col-md-4">
                                    <label for="tanggal">Tanggal</label>
                                    <input type="date" class="form-control" name="tanggal" id="tanggal"
                                        value="{{ $data->tanggal }}" readonly>
                                </div>
                                <div class="col-md-4">
                                    <label for="tanggal">Gardu Induk</label>
                                    <input type="text" class="form-control" name="tanggal" id="tanggal"
                                        value="{{ $data->gardu_induk }}" readonly>
                                </div>
                                <div class="col-md-4">
                                    <label for="tanggal">Incoming</label>
                                    <input type="text" class="form-control" name="tanggal" id="tanggal"
                                        value="{{ $data->incoming }}" readonly>
                                </div>
                            </div>

                            @foreach (array_chunk($timeSlots, 3) as $rowSlots)
                                <div class="row mt-2">
                                    @foreach ($rowSlots as $slot)
                                        <div class="col-md-4">
                                            <label for="idcell">{{ $slot }}</label>
                                            <input type="text" class="form-control" name="J{{ $slot }}"
                                                id="idcell" value="{{ $data->{$slot} }}">
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach

                            <div class="d-flex justify-content-end mt-2">
                                <button type="submit" class="btn btn-primary ms-2" id="submit">Update Data</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">

                    <div class="card-body">
                        <img src="{{ asset('img/Edit.png') }}" alt="" style="width: 100%; height:100%">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    {{-- <!-- JS Libraies -->
    <script src="{{ asset('library/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('library/jquery-ui-dist/jquery-ui.min.js') }}"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $("#table-1").dataTable({
            "columnDefs": [{
                "sortable": false,
                "targets": [2, 3]
            }]
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#formScadaFail').on('submit', function(e) {
                e.preventDefault(); // Prevent the default form submission

                var feederPkey = "{{ $data->feeder_pkey }}";
                var id = "{{ $id_status }}";

                var formData = new FormData(this);
                formData.append('feeder_pkey', feederPkey);

                $.ajax({
                    url: "{{ route('scadafail.update', ['id' => $id_status]) }}",

                    url: function() {
                        @if (Auth::user()->hasRole('Administrator'))
                            return "{{ route('scadafail.update', ['id' => $id_status]) }}";
                        @elseif (Auth::user()->hasRole('operator'))
                            return "{{ route('scadafail.update.operator', ['id' => $id_status]) }}";
                        @endif
                    }(),
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: response.message,
                                timer: 2000,
                                showConfirmButton: false
                            });

                            setTimeout(function() {
                                window.location.reload();
                            }, 2000);
                        } else {
                            // Show error toast
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: response.message,
                                timer: 3000,
                                showConfirmButton: false
                            });
                        }
                    },
                    error: function(xhr) {
                        // Handle network errors
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Something went wrong. Please try again.',
                            timer: 3000,
                            showConfirmButton: false
                        });
                    }
                });
            });
        });
    </script>
@endpush
