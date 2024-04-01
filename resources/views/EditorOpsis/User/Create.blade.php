@extends('layouts.app')

@section('title', 'Tambah User')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet"
        href="{{ asset('library/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('library/summernote/dist/summernote-bs4.min.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Tambah user</h1>
            </div>
        </section>

        <div class="card">
            <div class="card-body">

                <form action="{{ route('user.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <label for="">Name</label>
                            <input type="text" class="form-control" name="" id="">
                        </div>
                        <div class="col-md-6">
                            <label for="">Email</label>
                            <input type="email" class="form-control" name="" id="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="">Password</label>
                            <input type="text" class="form-control" name="" id="">
                        </div>
                        <div class="col-md-6">
                            <label for="">Role</label>
                            <select name="" id="" class="form-control form-select">
                                <option value="">--Pilih--</option>
                                <option value="">Administrator</option>
                                <option value="">Operator</option>
                                <option value="">Validator Opsis</option>
                                <option value="">Validator Fasop</option>
                                <option value="">Editor Opsis</option>
                                <option value="">Visitor</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mt-2">Tambah Data</button>
                </form>

            </div>
            <div class="card-footer">

            </div>
        </div>

    </div>

@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/simpleweather/jquery.simpleWeather.min.js') }}"></script>
    <script src="{{ asset('library/chart.js/dist/Chart.min.js') }}"></script>
    <script src="{{ asset('library/jqvmap/dist/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('library/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
    <script src="{{ asset('library/summernote/dist/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('library/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/index-0.js') }}"></script>
@endpush
