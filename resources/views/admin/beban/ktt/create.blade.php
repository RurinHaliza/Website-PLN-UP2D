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
                <h1>Detail KTT PLN</h1>
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

                        <form action="{{ route('store.ktt') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="idcell">Pkey</label>
                                    <input type="text" class="form-control" name="pkey" id="idcell">
                                </div>

                                <div class="col-md-6">
                                    <label for="idcell">station</label>
                                    <input type="text" class="form-control" name="station" id="idkelas">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <label for="idcell">nama</label>
                                    <input type="text" class="form-control" name="nama" id="idcell">
                                </div>

                                <div class="col-md-6">
                                    <label for="idcell">daya</label>
                                    <input type="text" class="form-control" name="daya" id="idkelas">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <label for="idcell">alamat</label>
                                    <input type="text" class="form-control" name="alamat" id="idcell">
                                </div>

                                <div class="col-md-6">
                                    <label for="idcell">tanggal</label>
                                    <input type="text" class="form-control" name="tanggal" id="idkelas">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <label for="idcell">cb</label>
                                    <input type="text" class="form-control" name="cb" id="idcell">
                                </div>

                                <div class="col-md-6">
                                    <label for="idcell">meter</label>
                                    <input type="text" class="form-control" name="meter" id="idkelas">
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-md-6">
                                    <label for="idcell">status_meter</label>
                                    <input type="text" class="form-control" name="status_meter" id="idkelas">
                                </div>
                            </div>

                            <div class="d-flex justify-content-end">

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
