@extends('layouts.app')

@section('title', 'Beban Bulanan')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.min.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Highlight Kondisi Sistem</h1>
                <div class="card-body">
                    <form action="{{ route('bebanharian') }}" method="GET">
                        <div class="row">
                            <div class="col-md-6">
                                <input type="date" name="selected_date" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <button class="btn btn-primary" type="submit"><i
                                        class="fas fa-2x fa-search"></i><span>Cari</span></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <a href="{{ url()->previous() }}" class="btn btn-danger mb-4">Kembali</a>

            <div class="section-body">
                @isset($data)
                    @php

                        //Siang
                        // Hitung rata-rata dari nilai kolom 01_00 dan 01_30
                        $averageValue = $data->avg(function ($item) {
                            return ($item->{"04_00"} + $item->{"04_30"} + $item->{"05_00"} + $item->{"05_30"} + $item->{"06_00"} + $item->{"06_30"} + $item->{"07_00"} + $item->{"07_30"} + $item->{"08_00"} + $item->{"08_30"} + $item->{"09_00"} + $item->{"09_30"} + $item->{"10_00"} + $item->{"10_30"} + $item->{"11_00"} + $item->{"11_30"} + $item->{"12_00"} + $item->{"12_30"} + $item->{"13_00"} + $item->{"13_30"} + $item->{"14_00"} + $item->{"14_30"} + $item->{"15_00"} + $item->{"15_30"} + $item->{"16_00"}) / 25;
                        });
                        // Menginisialisasi nilai maksimum dan nama kolom
                        $maxValue = 0;
                        $maxColumn = '';

                        // Melakukan iterasi melalui data
                        foreach ($data as $item) {
                            foreach (['04_00', '04_30', '05_00', '05_30', '06_00', '06_30', '07_00', '07_30', '08_00', '08_30', '09_00', '09_30', '10_00', '10_30', '11_00', '11_30', '12_00', '12_30', '13_00', '13_30', '14_00', '14_30', '15_00', '15_30', '16_00'] as $columnName) {
                                // Memeriksa jika nilai kolom saat ini lebih besar dari nilai maksimum sebelumnya
                                if ($item->{$columnName} > $maxValue) {
                                    // Jika ya, simpan nilai dan nama kolomnya
                                    $maxValue = $item->{$columnName};
                                    $maxColumn = $columnName;
                                }
                            }
                        }
                        //Malam
                        // Hitung rata-rata dari nilai kolom 01_00 dan 01_30
                        $averageValueM = $data->avg(function ($item) {
                            return ($item->{"16_30"} + $item->{"17_00"} + $item->{"17_30"} + $item->{"18_00"} + $item->{"18_30"} + $item->{"19_00"} + $item->{"19_30"} + $item->{"20_00"} + $item->{"20_30"} + $item->{"21_00"} + $item->{"21_30"} + $item->{"22_00"} + $item->{"22_30"} + $item->{"23_00"} + $item->{"23_30"} + $item->{"23_59"} + $item->{"00_30"} + $item->{"01_00"} + $item->{"01_30"} + $item->{"02_00"} + $item->{"02_30"} + $item->{"03_00"} + $item->{"03_30"}) / 23;
                        });
                        // Menginisialisasi nilai maksimum dan nama kolom
                        $maxValueM = 0;
                        $maxColumnM = '';

                        // Melakukan iterasi melalui data
                        foreach ($data as $item) {
                            foreach (['16_30', '17_00', '17_30', '18_00', '18_30', '19_00', '19_30', '20_00', '20_30', '21_00', '21_30', '22_00', '22_30', '23_00', '23_30', '23_59', '00_30', '01_00', '01_30', '02_00', '02_30', '03_00', '03_30'] as $columnNameM) {
                                // Memeriksa jika nilai kolom saat ini lebih besar dari nilai maksimum sebelumnya
                                if ($item->{$columnNameM} > $maxValueM) {
                                    // Jika ya, simpan nilai dan nama kolomnya
                                    $maxValueM = $item->{$columnNameM};
                                    $maxColumnM = $columnNameM;
                                }
                            }
                        }
                        // Analytics
                        
                        // Tahun
                        $maxValueYear = 0;
$maxColumnYear = '';
$maxDateYear = ''; // Tambahkan variabel untuk menyimpan tanggal

// Melakukan iterasi melalui data bulan ini
foreach ($dataBulanIni as $item) {
    foreach (['00_30', '01_00', '01_30', '02_00', '02_30', '03_00', '03_30', '04_00', '04_30', '05_00', '05_30', '06_00', '06_30', '07_00', '07_30', '08_00', '08_30', '09_00', '09_30', '10_00', '10_30', '11_00', '11_30', '12_00', '12_30', '13_00', '13_30', '14_00', '14_30', '15_00', '15_30', '16_00', '16_30', '17_00', '17_30', '18_00', '18_30', '19_00', '19_30', '20_00', '20_30', '21_00', '21_30', '22_00', '22_30', '23_00', '23_30', '23_59'] as $columnNameYear) {
        // Memeriksa jika nilai kolom saat ini lebih besar dari nilai maksimum sebelumnya
        if ($item->{$columnNameYear} > $maxValueYear) {
            // Jika ya, simpan nilai, nama kolom, dan tanggalnya
            $maxValueYear = $item->{$columnNameYear};
            $maxColumnYear = $columnNameYear;
            $maxDateYear = $item->tanggal; // Simpan tanggalnya
        }
    }
}


                        // Bulan
                        $maxValueMonth = 0;
$maxColumnMonth = '';
$maxDateMonth = ''; // Tambahkan variabel untuk menyimpan tanggal

// Melakukan iterasi melalui data bulan ini
foreach ($dataBulanIni as $item) {
    foreach (['00_30', '01_00', '01_30', '02_00', '02_30', '03_00', '03_30', '04_00', '04_30', '05_00', '05_30', '06_00', '06_30', '07_00', '07_30', '08_00', '08_30', '09_00', '09_30', '10_00', '10_30', '11_00', '11_30', '12_00', '12_30', '13_00', '13_30', '14_00', '14_30', '15_00', '15_30', '16_00', '16_30', '17_00', '17_30', '18_00', '18_30', '19_00', '19_30', '20_00', '20_30', '21_00', '21_30', '22_00', '22_30', '23_00', '23_30', '23_59'] as $columnNameMonth) {
        // Memeriksa jika nilai kolom saat ini lebih besar dari nilai maksimum sebelumnya
        if ($item->{$columnNameMonth} > $maxValueMonth) {
            // Jika ya, simpan nilai, nama kolom, dan tanggalnya
            $maxValueMonth = $item->{$columnNameMonth};
            $maxColumnMonth = $columnNameMonth;
            $maxDateMonth = $item->tanggal; // Simpan tanggalnya
        }
    }
}

// Sekarang, $maxDateMonth berisi tanggal di mana nilai tertinggi ditemukan

                        //Hari
                        $maxValueT = 0;
                        $maxColumnT = '';

                        // Melakukan iterasi melalui data
                        foreach ($dataHariIni as $item) {
                            foreach (['00_30', '01_00', '01_30', '02_00', '02_30', '03_00', '03_30', '04_00', '04_30', '05_00', '05_30', '06_00', '06_30', '07_00', '07_30', '08_00', '08_30', '09_00', '09_30', '10_00', '10_30', '11_00', '11_30', '12_00', '12_30', '13_00', '13_30', '14_00', '14_30', '15_00', '15_30', '16_00', '16_30', '17_00', '17_30', '18_00', '18_30', '19_00', '19_30', '20_00', '20_30', '21_00', '21_30', '22_00', '22_30', '23_00', '23_30', '23_59'] as $columnNameT) {
                                // Memeriksa jika nilai kolom saat ini lebih besar dari nilai maksimum sebelumnya
                                if ($item->{$columnNameT} > $maxValueT) {
                                    // Jika ya, simpan nilai dan nama kolomnya
                                    $maxValueT = $item->{$columnNameT};
                                    $maxColumnT = $columnNameT;
                                }
                            }
                        }
                    @endphp
                    {{-- <a href="{{ url()->previous() }}" class="btn btn-danger mb-4">Kembali</a> --}}
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card card-hero">
                                <div class="card-header">
                                    <div class="card-icon">
                                        <i class="far fa-question-circle"></i>
                                    </div>
                                    <h5>Analytical</h5>
                                </div>
                                <div class="card-body p-0">
                                    <div class="tickets-list">
                                        <a class="ticket-item">
                                            <div class="ticket-title">
                                                <h4>Beban Jatim Tertinggi Tahun ini</h4>
                                            </div>
                                            <div class="ticket-info">
                                                @if (!empty($maxValueYear))
                                                <div>MW : {{ $maxValueYear }}</div>
                                            @else
                                                <div>MW :</div>
                                            @endif
                                            </div>
                                            <div class="ticket-info">
                                                @if (!empty($maxValueYear))
                                                <div>Tanggal : {{ $maxDateYear }}</div>
                                            @else
                                                <div>Tanggal : </div>
                                            @endif
                                            </div>
                                            <div class="ticket-info">
                                                @if (!empty($maxValueYear))
                                                <div>Pukul : {{ $maxColumnYear }}</div>
                                            @else
                                                <div>Pukul : </div>
                                            @endif
                                            </div>
                                        </a>
                                        <a class="ticket-item">
                                            <div class="ticket-title">
                                                <h4>Beban Jatim Tertinggi Bulan ini</h4>
                                            </div>
                                            <div class="ticket-info">
                                                @if (!empty($maxValueMonth))
                                                <div>MW : {{ $maxValueMonth }}</div>
                                            @else
                                                <div>MW :</div>
                                            @endif
                                            </div>
                                            <div class="ticket-info">
                                                @if (!empty($maxValueMonth))
                                                <div>Tanggal : {{ $maxDateMonth }}</div>
                                            @else
                                                <div>Tanggal : </div>
                                            @endif
                                            </div>
                                            <div class="ticket-info">
                                                @if (!empty($maxValueMonth))
                                                <div>Pukul : {{ $maxColumnMonth }}</div>
                                            @else
                                                <div>Pukul : </div>
                                            @endif
                                            </div>
                                        </a>
                                        <a class="ticket-item">
                                            <div class="ticket-title">
                                                <h4>Beban Jatim Tertinggi Hari ini</h4>
                                            </div>
                                            <div class="ticket-info">
                                                @if ($maxValueT > 0)
                                                    <div>Tertinggi : {{ $maxValueT }}</div>
                                                @else
                                                    <div>Tertinggi :</div>
                                                @endif
                                            </div>
                                            <div class="ticket-info">
                                                @if ($maxValueT > 0)
                                                    <div>Pukul : {{ $maxColumnT }}</div>
                                                @else
                                                    <div>Pukul :</div>
                                                @endif
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card card-hero">
                                <div class="card-body p-0">
                                    <div class="tickets-list">
                                        <a class="ticket-item">
                                            <div class="ticket-title">
                                                <h4>Beban Siang</h4>
                                            </div>
                                            <div class="ticket-info">
                                                @if ($maxValue > 0)
                                                    <div>Tertinggi : {{ $maxValue }}</div>
                                                @else
                                                    <div>Tertinggi :</div>
                                                @endif
                                            </div>
                                            <div class="ticket-info">
                                                <div>Tanggal : {{ $selectedDate }}</div>
                                            </div>
                                            <div class="ticket-info">
                                                @if ($maxValue > 0)
                                                    <div>Pukul : {{ $maxColumn }}</div>
                                                @else
                                                    <div>Pukul :</div>
                                                @endif
                                            </div>
                                            <div class="ticket-info">
                                                <div>Rata-Rata : {{ $averageValue }}</div>
                                            </div>
                                        </a>
                                        <a class="ticket-item">
                                            <div class="ticket-title">
                                                <h4>Beban Malam</h4>
                                            </div>
                                            <div class="ticket-info">
                                                @if ($maxValueM > 0)
                                                    <div>Tertinggi : {{ $maxValueM }}</div>
                                                @else
                                                    <div>Tertinggi :</div>
                                                @endif
                                            </div>
                                            <div class="ticket-info">
                                                <div>Tanggal : {{ $selectedDate }}</div>
                                            </div>
                                            <div class="ticket-info">
                                                @if ($maxValueM > 0)
                                                    <div>Pukul : {{ $maxColumnM }}</div>
                                                @else
                                                    <div>Pukul :</div>
                                                @endif
                                            </div>
                                            <div class="ticket-info">
                                                <div>Rata-Rata : {{ $averageValueM }}</div>
                                            </div>
                                        </a>
                                        {{-- <a class="ticket-item">
                                        <div class="ticket-title">
                                            <button class="btn btn-primary">Beban Trafo</button>
                                        </div>
                                    </a>
                                    <a class="ticket-item">
                                        <div class="ticket-info">
                                            <button class="btn btn-primary">Beban Penyulang</button>
                                        </div>
                                    </a>
                                    <a class="ticket-item">
                                        <div class="ticket-info">
                                            <button class="btn btn-primary">Beban UP3</button>
                                        </div>
                                    </a>
                                    <a class="ticket-item">
                                        <div class="ticket-info">
                                            <button class="btn btn-primary">Beban KTT</button>
                                        </div>
                                    </a> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Simple Table</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        @if ($data->count() > 0)
                                            <table id="bebanhari" class="table-bordered table-md table">
                                                <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>00.30</th>
                                                    <th>01.00</th>
                                                    <th>01.30</th>
                                                    <th>02.00</th>
                                                    <th>02.30</th>
                                                    <th>03.00</th>
                                                    <th>03.30</th>
                                                    <th>04.00</th>
                                                    <th>04.30</th>
                                                    <th>05.00</th>
                                                    <th>05.30</th>
                                                    <th>06.00</th>
                                                    <th>06.30</th>
                                                    <th>07.00</th>
                                                    <th>07.30</th>
                                                    <th>08.00</th>
                                                    <th>08.30</th>
                                                    <th>09.00</th>
                                                    <th>09.30</th>
                                                    <th>10.00</th>
                                                    <th>10.30</th>
                                                    <th>11.00</th>
                                                    <th>11.30</th>
                                                    <th>12.00</th>
                                                    <th>12.30</th>
                                                    <th>13.00</th>
                                                    <th>13.30</th>
                                                    <th>14.00</th>
                                                    <th>14.30</th>
                                                    <th>15.00</th>
                                                    <th>15.30</th>
                                                    <th>16.00</th>
                                                    <th>16.30</th>
                                                    <th>17.00</th>
                                                    <th>17.30</th>
                                                    <th>18.00</th>
                                                    <th>18.30</th>
                                                    <th>19.00</th>
                                                    <th>19.30</th>
                                                    <th>20.00</th>
                                                    <th>20.30</th>
                                                    <th>21.00</th>
                                                    <th>21.30</th>
                                                    <th>22.00</th>
                                                    <th>22.30</th>
                                                    <th>23.00</th>
                                                    <th>23.30</th>
                                                    <th>23.59</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($data as $item)
                                                    <tr>
                                                        <td>{{ $item->gardu_induk }}</td>
                                                        <td>{{ $item->{'00_30'} }}</td>
                                                        <td>{{ $item->{'01_00'} }}</td>
                                                        <td>{{ $item->{'01_30'} }}</td>
                                                        <td>{{ $item->{'02_00'} }}</td>
                                                        <td>{{ $item->{'02_30'} }}</td>
                                                        <td>{{ $item->{'03_00'} }}</td>
                                                        <td>{{ $item->{'03_30'} }}</td>
                                                        <td>{{ $item->{'04_00'} }}</td>
                                                        <td>{{ $item->{'04_30'} }}</td>
                                                        <td>{{ $item->{'05_00'} }}</td>
                                                        <td>{{ $item->{'05_30'} }}</td>
                                                        <td>{{ $item->{'06_00'} }}</td>
                                                        <td>{{ $item->{'06_30'} }}</td>
                                                        <td>{{ $item->{'07_00'} }}</td>
                                                        <td>{{ $item->{'07_30'} }}</td>
                                                        <td>{{ $item->{'08_00'} }}</td>
                                                        <td>{{ $item->{'08_30'} }}</td>
                                                        <td>{{ $item->{'09_00'} }}</td>
                                                        <td>{{ $item->{'09_30'} }}</td>
                                                        <td>{{ $item->{'10_00'} }}</td>
                                                        <td>{{ $item->{'10_30'} }}</td>
                                                        <td>{{ $item->{'11_00'} }}</td>
                                                        <td>{{ $item->{'11_30'} }}</td>
                                                        <td>{{ $item->{'12_00'} }}</td>
                                                        <td>{{ $item->{'12_30'} }}</td>
                                                        <td>{{ $item->{'13_00'} }}</td>
                                                        <td>{{ $item->{'13_30'} }}</td>
                                                        <td>{{ $item->{'14_00'} }}</td>
                                                        <td>{{ $item->{'14_30'} }}</td>
                                                        <td>{{ $item->{'15_00'} }}</td>
                                                        <td>{{ $item->{'15_30'} }}</td>
                                                        <td>{{ $item->{'16_00'} }}</td>
                                                        <td>{{ $item->{'16_30'} }}</td>
                                                        <td>{{ $item->{'17_00'} }}</td>
                                                        <td>{{ $item->{'17_30'} }}</td>
                                                        <td>{{ $item->{'18_00'} }}</td>
                                                        <td>{{ $item->{'18_30'} }}</td>
                                                        <td>{{ $item->{'19_00'} }}</td>
                                                        <td>{{ $item->{'19_30'} }}</td>
                                                        <td>{{ $item->{'20_00'} }}</td>
                                                        <td>{{ $item->{'20_30'} }}</td>
                                                        <td>{{ $item->{'21_00'} }}</td>
                                                        <td>{{ $item->{'21_30'} }}</td>
                                                        <td>{{ $item->{'22_00'} }}</td>
                                                        <td>{{ $item->{'22_30'} }}</td>
                                                        <td>{{ $item->{'23_00'} }}</td>
                                                        <td>{{ $item->{'23_30'} }}</td>
                                                        <td>{{ $item->{'23_30'} }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                            </table>
                                        @else
                                            <table id="bebanhari" class="table-bordered table-md-6 table">
                                                <tr>
                                                    <th>Name</th>
                                                    <th>00.30</th>
                                                    <th>01.00</th>
                                                    <th>01.30</th>
                                                    <th>02.00</th>
                                                    <th>02.30</th>
                                                    <th>03.00</th>
                                                    <th>03.30</th>
                                                    <th>04.00</th>
                                                    <th>04.30</th>
                                                    <th>05.00</th>
                                                    <th>05.30</th>
                                                    <th>06.00</th>
                                                    <th>06.30</th>
                                                    <th>07.00</th>
                                                    <th>07.30</th>
                                                    <th>08.00</th>
                                                    <th>08.30</th>
                                                    <th>09.00</th>
                                                    <th>09.30</th>
                                                    <th>10.00</th>
                                                    <th>10.30</th>
                                                    <th>11.00</th>
                                                    <th>11.30</th>
                                                    <th>12.00</th>
                                                    <th>12.30</th>
                                                    <th>13.00</th>
                                                    <th>13.30</th>
                                                    <th>14.00</th>
                                                    <th>14.30</th>
                                                    <th>15.00</th>
                                                    <th>15.30</th>
                                                    <th>16.00</th>
                                                    <th>16.30</th>
                                                    <th>17.00</th>
                                                    <th>17.30</th>
                                                    <th>18.00</th>
                                                    <th>18.30</th>
                                                    <th>19.00</th>
                                                    <th>19.30</th>
                                                    <th>20.00</th>
                                                    <th>20.30</th>
                                                    <th>21.00</th>
                                                    <th>21.30</th>
                                                    <th>22.00</th>
                                                    <th>22.30</th>
                                                    <th>23.00</th>
                                                    <th>23.30</th>
                                                    <th>23.59</th>
                                                </tr>
                                                <tr>
                                                </tr>
                                                <tr>
                                                    <th></th>
                                                </tr>
                                                <tr>
                                                    <th></th>
                                                </tr>
                                                <tr>
                                                    <th></th>
                                                </tr>
                                            </table>
                                            
                                        @endif
                                    @endisset
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <nav class="d-inline-block">
                                    <ul class="pagination mb-0">
                                        <li class="page-item disabled">
                                            <a class="page-link" href="#" tabindex="-1"><i
                                                    class="fas fa-chevron-left"></i></a>
                                        </li>
                                        <li class="page-item active"><a class="page-link" href="#">1 <span
                                                    class="sr-only">(current)</span></a></li>
                                        <li class="page-item">
                                            <a class="page-link" href="#">2</a>
                                        </li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        <li class="page-item">
                                            <a class="page-link" href="#"><i class="fas fa-chevron-right"></i></a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-header">
                                <h4>Daftar Trafo > 80%</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table-bordered table-md table">
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Trafo</th>
                                        </tr>
                                        <tr>
                                            <th>1</th>
                                            <th>BDBO</th>
                                            <th>3</th>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <nav class="d-inline-block">
                                    <ul class="pagination mb-0">
                                        <li class="page-item disabled">
                                            <a class="page-link" href="#" tabindex="-1"><i
                                                    class="fas fa-chevron-left"></i></a>
                                        </li>
                                        <li class="page-item active"><a class="page-link" href="#">1 <span
                                                    class="sr-only">(current)</span></a></li>
                                        <li class="page-item">
                                            <a class="page-link" href="#">2</a>
                                        </li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        <li class="page-item">
                                            <a class="page-link" href="#"><i class="fas fa-chevron-right"></i></a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-header">
                                <h4>Daftar Trafo < 30%</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table-bordered table-md table">
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Trafo</th>
                                        </tr>
                                        <tr>
                                            <th>1</th>
                                            <th>BDBO</th>
                                            <th>3</th>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <nav class="d-inline-block">
                                    <ul class="pagination mb-0">
                                        <li class="page-item disabled">
                                            <a class="page-link" href="#" tabindex="-1"><i
                                                    class="fas fa-chevron-left"></i></a>
                                        </li>
                                        <li class="page-item active"><a class="page-link" href="#">1 <span
                                                    class="sr-only">(current)</span></a></li>
                                        <li class="page-item">
                                            <a class="page-link" href="#">2</a>
                                        </li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        <li class="page-item">
                                            <a class="page-link" href="#"><i class="fas fa-chevron-right"></i></a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h4>Statistics</h4>
                                <div class="card-header-action">
                                    <a href="#" class="btn active">Week</a>
                                    <a href="#" class="btn">Month</a>
                                    <a href="#" class="btn">Year</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <canvas id="myChart2" height="180"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </section>

@endsection

@push('scripts')
    <script src="{{ asset('library/chart.js/dist/Chart.min.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- JS Libraies -->
    <script src="{{ asset('library/jquery-sparkline/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('library/chart.js/dist/Chart.min.js') }}"></script>
    <script src="{{ asset('library/jqvmap/dist/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('library/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
    <script src="{{ asset('library/jqvmap/dist/maps/jquery.vmap.indonesia.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/components-statistic.js') }}"></script>
    <script>
        $("#jumlahfeederup3").dataTable({});
    </script>

<script>
    $("#bebanhari").dataTable({});
</script>

    <script>
        var ctx = document.getElementById('barChart').getContext('2d');
        var myChart2 = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ["0", "1", "2", "3", "4", "5"],
                datasets: [{
                        label: 'Parameter 1', // Name the series
                        data: ['30', '20', '12', '23', '33', '56'], // Specify the data values array
                        fill: false,
                        borderColor: '#ffd000', // Add custom color border (Line)
                        backgroundColor: '#ffd000', // Add custom color background (Points and Fill)
                        borderWidth: 3 // Specify bar border width
                    },
                    {
                        label: 'Parameter 2',
                        data: ['14', '45', '15', '27', '56', '50'],
                        fill: false,
                        borderColor: '#ff0000', // Add custom color border (Line)
                        backgroundColor: '#ff0000', // Add custom color background (Points and Fill)
                        borderWidth: 3 // Specify bar border width
                    }
                ]
            },
            options: {
                responsive: true, // Instruct chart js to respond nicely.
                maintainAspectRatio: false, // Add to prevent default behaviour of full-width/height
            }
        });
        
    </script>
@endpush