@extends('layouts.app')

@section('title', 'Konsumen Tegangan Tinggi')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.min.css') }}">
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

                        <form action="" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="tanggal">Tanggal</label>
                                    <input type="date" class="form-control" name="tanggal" id="idcell"
                                        value="{{ $data->tanggal }}">
                                </div>

                                <div class="col-md-4">
                                    <label for="idcell">00_30</label>
                                    <input type="text" class="form-control" name="J00_30" id="idkelas"
                                        value="{{ $data->{'00_30'} }}">
                                </div>

                                <div class="col-md-4">
                                    <label for="idcell">01_00</label>
                                    <input type="text" class="form-control" name="J01_00" id="idkelas"
                                        value="{{ $data->{'01_00'} }}">
                                </div>

                            </div>

                            <div class="row mt-2">

                                <div class="col-md-4">
                                    <label for="idcell">01_30</label>
                                    <input type="text" class="form-control" name="J01_30" id="idkelas"
                                        value="{{ $data->{'01_30'} }}">
                                </div>

                                <div class="col-md-4">
                                    <label for="idcell">02_00</label>
                                    <input type="text" class="form-control" name="J02_00" id="idkelas"
                                        value="{{ $data->{'02_00'} }}">
                                </div>

                                <div class="col-md-4">
                                    <label for="idcell">02_30</label>
                                    <input type="text" class="form-control" name="J02_30" id="idkelas"
                                        value="{{ $data->{'02_30'} }}">
                                </div>
                            </div>

                            <div class="d-flex justify-content-end mt-2">

                                <button type="submit" class="btn btn-primary ms-2" id="submit" href="#">Update
                                    Data</button>

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

    <script>
        $("#table-1").dataTable({
            "columnDefs": [{
                "sortable": false,
                "targets": [2, 3]
            }]
        });
    </script>
@endpush
