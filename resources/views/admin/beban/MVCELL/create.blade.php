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
                <h1>Detail MVCELL</h1>
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
                                <div class="col-md-6">
                                    <label for="idcell">ID CELL</label>
                                    <input type="text" class="form-control" name="" id="idcell" value="{{ $data->ID_CELL }}">
                                </div>
            
                                <div class="col-md-6">
                                    <label for="idcell">ID KELAS</label>
                                    <input type="text" class="form-control" name="" id="idkelas" value="{{ $data->ID_KELAS }}">
                                </div>
            
                            </div>
            
                            <div class="row  ">
                                <div class="col-md-6">
                                    <label for="idcell">Lokasi penempatan</label>
                                    <input type="text" class="form-control" name="" id="lokasi" value="{{ $data->LOKASI_PENEMPATAN }}">
                                </div>
            
                                <div class="col-md-6">
                                    <label for="idcell">MERK</label>
                                    <input type="text" class="form-control" name="" id="merk" value="{{ $data->MERK }}">
                                </div>
            
                            </div>
            
                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <label for="idcell">Type </label>
                                    <input type="text" class="form-control" name="tipe" id="" value="{{ $data->TYPE }}">
                                </div>
            
                                <div class="col-md-6">
                                    <label for="idcell">NO SERI</label>
                                    <input type="text" class="form-control" name="noseri" id="" value="{{ $data->NO_SERI }}">
                                </div>
            
                            </div>
            
                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <label for="idcell">MERK 2 </label>
                                    <input type="text" class="form-control" name="merk2" id="" value="{{ $data->MERK_2 }}">
                                </div>
            
                                <div class="col-md-6">
                                    <label for="idcell">TYPE 2</label>
                                    <input type="text" class="form-control" name="tipe2" id="" value="{{ $data->TYPE_2 }}">
                                </div>
            
                            </div>
            
                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <label for="idcell">NO SERI 2 </label>
                                    <input type="text" class="form-control" name="noseri2" id="" value="{{ $data->NO_SERI_2 }}">
                                </div>
            
                                <div class="col-md-6">
                                    <label for="idcell">Jenis</label>
                                    <input type="text" class="form-control" name="" id="jenis" value="{{ $data->JENIS }}">
                                </div>
            
                            </div>
            
                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <label for="idcell">NAMA </label>
                                    <input type="text" class="form-control" name="namajtm" id="" value="{{ $data->NAMA_JTM }}">
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
