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

                        <form action="{{ route('update.data.trafo',[$data->id]) }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="idcell">Nama GI</label>
                                    <input type="text" class="form-control" name="nama_gi" id="idcell" value="{{ $data->Nama_GI }}">
                                </div>
            
                                <div class="col-md-6">
                                    <label for="idcell">TRAFO</label>
                                    <input type="text" class="form-control" name="trafo" id="idkelas" value="{{ $data->TRAFO }}">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <label for="idcell">ID_TRAFO</label>
                                    <input type="text" class="form-control" name="id_trafo" id="idcell" value="{{ $data->ID_TRAFO }}">
                                </div>
            
                                <div class="col-md-6">
                                    <label for="idcell">ID_KELAS</label>
                                    <input type="text" class="form-control" name="id_kelas" id="idkelas" value="{{ $data->ID_KELAS }}">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <label for="idcell">KD_PEMILIK</label>
                                    <input type="text" class="form-control" name="kd_pemilik" id="idcell" value="{{ $data->KD_PEMILIK }}">
                                </div>
            
                                <div class="col-md-6">
                                    <label for="idcell">KD_PENGELOLA</label>
                                    <input type="text" class="form-control" name="pengelola" id="idkelas" value="{{ $data->KD_PENGELOLA }}">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <label for="idcell">TINGKAT_RESIKO</label>
                                    <input type="text" class="form-control" name="tingkat_resiko" id="idcell" value="{{ $data->TINGKAT_RESIKO }}">
                                </div>
            
                                <div class="col-md-6">
                                    <label for="idcell">KODE_PERALATAN</label>
                                    <input type="text" class="form-control" name="kode" id="idkelas" value="{{ $data->KODE_PERALATAN }}">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <label for="idcell">MERK</label>
                                    <input type="text" class="form-control" name="merk" id="idcell" value="{{ $data->MERK }}">
                                </div>
            
                                <div class="col-md-6">
                                    <label for="idcell">NO_SERI</label>
                                    <input type="text" class="form-control" name="no_seri" id="idkelas" value="{{ $data->NO_SERI }}">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <label for="idcell">PERUNTUKAN</label>
                                    <input type="text" class="form-control" name="peruntukan" id="idcell" value="{{ $data->PERUNTUKAN }}">
                                </div>
            
                                <div class="col-md-6">
                                    <label for="idcell">JENIS</label>
                                    <input type="text" class="form-control" name="jenis" id="jenis" value="{{ $data->JENIS }}">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <label for="idcell">STATUS</label>
                                    <input type="text" class="form-control" name="status" id="idcell" value="{{ $data->STATUS }}">
                                </div>
            
                                <div class="col-md-6">
                                    <label for="idcell">TGL_PASANG</label>
                                    <input type="text" class="form-control" name="tgl_pasang" id="idkelas" value="{{ $data->TGL_PASANG }}">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <label for="idcell">TGL_OPERASI</label>
                                    <input type="text" class="form-control" name="tgl_operasi" id="idcell" value="{{ $data->TGL_OPERASI }}">
                                </div>
            
                                <div class="col-md-6">
                                    <label for="idcell">NILAI_PEROLEHAN</label>
                                    <input type="text" class="form-control" name="" id="idkelas" value="{{ $data->NILAI_PEROLEHAN }}">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <label for="idcell">NILAI_BUKU</label>
                                    <input type="text" class="form-control" name="nilai_buku" id="idcell" value="{{ $data->NILAI_BUKU }}">
                                </div>
            
                                <div class="col-md-6">
                                    <label for="idcell">UMUR_EKONOMIS</label>
                                    <input type="text" class="form-control" name="umur_manfaat" id="idkelas" value="{{ $data->UMUR_EKONOMIS }}">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <label for="idcell">UMUR_MANFAAT</label>
                                    <input type="text" class="form-control" name="umur_ekonomis" id="idcell" value="{{ $data->UMUR_MANFAAT }}">
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
