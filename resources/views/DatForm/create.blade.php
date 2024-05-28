@extends('layouts.app')

@section('title', 'Data Form')

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
                <h1>Tambah Data</h1>
            </div>
        </section>
        <a href="{{ url()->previous() }}" class="btn btn-danger">Kembali</a>

        <div class="row">
            <div class="col-md-8">
                <div class="card mt-3">
                    <div class="card-header">
                        <h5 class="m-0 font-weight-bold text-primary">Tambah Rincian Data</h5>
                    </div>
                    <div class="card-body">

                        <form action="{{ route('dataform.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="idcell">Gardu Induk</label>
                                    <select name="" id="" class="form-control form-select">
                                        @foreach ($gi as $g => $ga)
                                            <option value="{{ $ga->Nama_GI }}">{{ $ga->Nama_GI }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label for="idcell">Wilayah</label>
                                    <select name="" id="" class="form-control form-select">
                                        <option value="TGH">Tengah</option>
                                        <option value="BRT">Barat</option>
                                        <option value="TMR">Timur</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <label for="idcell">UP3</label>
                                    <select name="" id="" class="form-control form-select">
                                        @foreach (config('wilayah.UP3') as $key => $item)
                                            <option value="{{ $key }}">{{ $item }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label for="idcell">No Trafo</label>
                                    <input type="text" class="form-control" name="NM_JTM" id="idkelas">
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <label for="idcell">Primer</label>
                                    <input type="text" class="form-control" name="ID_TRAFOGI" id="idcell">
                                </div>

                                <div class="col-md-6">
                                    <label for="idcell">Sekunder</label>
                                    <input type="text" class="form-control" name="NM_JTM" id="idkelas">
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <label for="idcell">Daya</label>
                                    <input type="text" class="form-control" name="ID_TRAFOGI" id="idcell">
                                </div>

                                <div class="col-md-6">
                                    <label for="idcell">Inom</label>
                                    <input type="text" class="form-control" name="NM_JTM" id="idkelas">
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <label for="idcell">I Siang</label>
                                    <input type="text" class="form-control" name="ID_TRAFOGI" id="idcell">
                                </div>

                                <div class="col-md-6">
                                    <label for="idcell">I Malam Hari ini</label>
                                    <input type="text" class="form-control" name="NM_JTM" id="idkelas">
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <label for="idcell">Persen Siang</label>
                                    <input type="text" class="form-control" name="ID_TRAFOGI" id="idcell">
                                </div>

                                <div class="col-md-6">
                                    <label for="idcell">Persen Malam Hari ini</label>
                                    <input type="text" class="form-control" name="NM_JTM" id="idkelas">
                                </div>
                            </div>

                            <div class="d-flex justify-content-end mt-3">

                                <button type="submit" class="btn btn-primary ms-2 mr-2" id="submit" href="#">Tambah
                                    Data</button>
                                <button type="submit" class="btn btn-warning ms-2 mr-2" id="submit" href="#">Ambil
                                    Data
                                    Data</button>
                                <button type="submit" class="btn btn-danger ms-2 mr-2" id="submit" href="#">Hitung
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
