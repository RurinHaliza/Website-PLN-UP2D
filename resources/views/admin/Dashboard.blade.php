@extends('layouts.app')

@section('title', 'Dashboard')

@push('style')
    <link rel="stylesheet"
        href="{{ asset('library/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('library/summernote/dist/summernote-bs4.min.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Dashboard Administrator</h1>
            </div>
        </section>

        <div class="row">

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h3>Analytical</h3>
                    </div>
                    <div class="card-body">
                        <ul>
                            <li>Beban Tertinggi Jatim Tahun Ini</li>
                            <ul>
                                <li>MW: </li>
                                <li>Tanggal</li>
                                <li>Pukul</li>
                            </ul>
                            <li>Beban Tertinggi Jatim Bulan Ini</li>
                            <ul>
                                <li>MW: </li>
                                <li>Tanggal</li>
                                <li>Pukul</li>
                            </ul>
                            <li>Beban Tertinggi Jatim Tahun Ini</li>
                            <ul>
                                <li>MW: </li>
                                <li>Tanggal</li>
                                <li>Pukul</li>
                            </ul>
                            <li>Beban Tertinggi Jatim Hari Ini</li>
                            <ul>
                                <li>MW: </li>
                                <li>Tanggal</li>
                                <li>Pukul</li>
                            </ul>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card"></div>
                <img src="{{ asset('img/PetaJatim.png') }}" alt="" style="width: 100%">
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
