@extends('layouts.app')

@section('title', 'Gardu Induk')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.min.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('library/datatables/media/css/jquery.dataTables.min.css') }}"> --}}
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Detail MVCELL : {{ $data->ID_TRAFO }}</h1>
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

                        <form action="{{ route('update.data.penyulang',[$data->id]) }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="idcell">ID_JTM</label>
                                    <input type="text" class="form-control" name="ID_JTM" id="idcell" value="{{ $data->ID_JTM }}">
                                </div>
            
                                <div class="col-md-6">
                                    <label for="idcell">ID_GI</label>
                                    <input type="text" class="form-control" name="ID_GI" id="idkelas" value="{{ $data->ID_GI }}">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <label for="idcell">ID_TRAFOGI</label>
                                    <input type="text" class="form-control" name="ID_TRAFOGI" id="idcell" value="{{ $data->ID_TRAFOGI }}">
                                </div>
            
                                <div class="col-md-6">
                                    <label for="idcell">NM_JTM</label>
                                    <input type="text" class="form-control" name="NM_JTM" id="idkelas" value="{{ $data->NM_JTM }}">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <label for="idcell">NM_GI</label>
                                    <input type="text" class="form-control" name="NM_GI" id="idcell" value="{{ $data->NM_GI }}">
                                </div>
            
                                <div class="col-md-6">
                                    <label for="idcell">NM_SINGKATAN</label>
                                    <input type="text" class="form-control" name="NM_SINGKATAN" id="idkelas" value="{{ $data->NM_SINGKATAN }}">
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <label for="idcell">UP3</label>
                                    <input type="text" class="form-control" name="UP3" id="idcell" value="{{ $data->UP3 }}">
                                </div>
            
                                <div class="col-md-6">
                                    <label for="idcell">ULP</label>
                                    <input type="text" class="form-control" name="ULP" id="idkelas" value="{{ $data->ULP }}">
                                </div>
                            </div>

                            <div class="d-flex justify-content-end">
                               
                                <button type="submit" class="btn btn-primary ms-2" id="submit" href="#">Update Data</button>
                            
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
