@extends('layouts.app')

@section('title', 'Beban Bulanan')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.min.css') }}">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.js"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.min.js"></script>
    <link rel="stylesheet" type="text/css" media="screen" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/themes/base/jquery-ui.css">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <<div class="section-header">
                <h1>Highlight Kondisi Sistem</h1>
                <div class="card-body">
                </div>
    </div>
    <a href="{{ route('bebansemua') }}" class="btn btn-danger mb-4">Kembali</a>
    <div class="section-body">
        <div class="card">
            <div class="card-body">
                <div class="section-title mt-0">Simple</div>
                <ul class="nav nav-pills" id="tabList">
                    <li class="nav-item">
                        <a class="nav-link active" href="#tabHarian">Harian</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#tabMingguan">Mingguan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#tabBulanan">Bulanan</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="tab-content">
            <div class="tab-pane fade show active" id="tabHarian">
                <!-- Konten untuk tab Harian -->


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
                                            @if ($maxValueToday > 0)
                                                <div>Tertinggi : {{ $maxValueToday }}</div>
                                            @else
                                                <div>Tertinggi :</div>
                                            @endif
                                        </div>
                                        <div class="ticket-info">
                                            @if ($maxValueToday > 0)
                                                <div>Pukul : {{ $maxColumnToday }}</div>
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

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-header">
                                    <h4>Simple Table</h4>
                                    <div class="card-body">
                                        <form action="{{ route('detailbeban') }}" method="GET">
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
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    @if ($data->count() > 0)
                                        <table id="bebantrafo" class="table-bordered table-md table">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Incoming</th>
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
                                            </thead>
                                            <tbody>
                                                @foreach ($data as $item)
                                                    <tr>
                                                        <td>{{ $item->gardu_induk }}</td>
                                                        <td>{{ $item->incoming }}</td>
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
                                                        <td>{{ $item->{'23_59'} }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    @else
                                        <table id="bebanhari" class="table-bordered table-md-6 table">
                                            <tr>
                                                <th>Name</th>
                                                <th>Incoming</th>
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
                                        </table>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div style="width: 100%; height:170px; margin: auto;">
                                    <canvas id="chartharian"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="tab-pane fade" id="tabMingguan">
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
                                            @if ($maxValueToday > 0)
                                                <div>Tertinggi : {{ $maxValueToday }}</div>
                                            @else
                                                <div>Tertinggi :</div>
                                            @endif
                                        </div>
                                        <div class="ticket-info">
                                            @if ($maxValueToday > 0)
                                                <div>Pukul : {{ $maxColumnToday }}</div>
                                            @else
                                                <div>Pukul :</div>
                                            @endif
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-9 col-lg-9">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-header">
                                    <h4>Simple Table</h4>
                                    <div class="card-body">
                                        <form action="{{ route('detailbeban') }}" method="GET">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <input type="date" name="start_date" class="form-control">
                                                </div>
                                                <div class="col-md-4">
                                                    <input type="date" name="end_date" class="form-control">
                                                </div>
                                                <div class="col-md-4">
                                                    <button class="btn btn-primary" type="submit"><i
                                                            class="fas fa-2x fa-search"></i><span>Cari</span></button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    @if ($data3->count() > 0)
                                        <table id="bebantrafo" class="table-bordered table-md table">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Incoming</th>
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
                                            </thead>
                                            <tbody>
                                                @foreach ($data3 as $item)
                                                    <tr>
                                                        <td>{{ $item->gardu_induk }}</td>
                                                        <td>{{ $item->incoming }}</td>
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
                                                        <td>{{ $item->{'23_59'} }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    @else
                                        <table id="bebanhari" class="table-bordered table-md-6 table">
                                            <tr>
                                                <th>Name</th>
                                                <th>Incoming</th>
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
                                        </table>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="tab-pane fade" id="tabBulanan">
                <!-- Konten untuk tab Bulanan -->
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
                                            @if ($maxValueToday > 0)
                                                <div>Tertinggi : {{ $maxValueToday }}</div>
                                            @else
                                                <div>Tertinggi :</div>
                                            @endif
                                        </div>
                                        <div class="ticket-info">
                                            @if ($maxValueToday > 0)
                                                <div>Pukul : {{ $maxColumnToday }}</div>
                                            @else
                                                <div>Pukul :</div>
                                            @endif
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-9 col-lg-9">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-header">
                                    <h4>Simple Table</h4>
                                    <div class="card-body">
                                        <form action="{{ route('detailbeban') }}" method="GET">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <span>Pilih Bulan: </span> 
                                                    <input name="StartBulan" id="startDate" class="date-picker" />

                                                </div>
                                                <div class="col-md-4">
                                                    <button class="btn btn-primary" type="submit"><i
                                                            class="fas fa-2x fa-search"></i><span>Cari</span></button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    @if ($data2->count() > 0)
                                        <table id="bebantrafo" class="table-bordered table-md table">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Incoming</th>
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
                                            </thead>
                                            <tbody>
                                                @foreach ($data2 as $item)
                                                    <tr>
                                                        <td>{{ $item->gardu_induk }}</td>
                                                        <td>{{ $item->incoming }}</td>
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
                                                        <td>{{ $item->{'23_59'} }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    @else
                                        <table id="bebanhari" class="table-bordered table-md-6 table">
                                            <tr>
                                                <th>Name</th>
                                                <th>Incoming</th>
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
                                        </table>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

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
        $("#bebantrafo").dataTable({
            "columnDefs": [{
                "sortable": false,
                "targets": [2, 3],
            }]
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Mengambil semua elemen tab
            var tabs = document.querySelectorAll('.nav-link');
    
            // Fungsi untuk mengaktifkan tab berdasarkan ID
            function activateTab(targetId) {
                // Menghapus kelas 'active' dari semua tab
                tabs.forEach(function(tab) {
                    tab.classList.remove('active');
                });
                // Menghapus kelas 'show active' dari semua tab konten
                var tabContents = document.querySelectorAll('.tab-pane');
                tabContents.forEach(function(content) {
                    content.classList.remove('show', 'active');
                });
                // Menambahkan kelas 'active' ke tab yang sesuai
                document.querySelector(`.nav-link[href="${targetId}"]`).classList.add('active');
                // Menambahkan kelas 'show active' ke konten tab yang sesuai
                document.querySelector(targetId).classList.add('show', 'active');
            }
    
            // Menetapkan event listener untuk setiap tab
            tabs.forEach(function(tab) {
                tab.addEventListener('click', function(event) {
                    var targetId = tab.getAttribute('href');
                    // Mengaktifkan tab yang diklik
                    activateTab(targetId);
                    // Menyimpan ID tab yang aktif di localStorage
                    localStorage.setItem('activeTab', targetId);
                    // Mencegah tindakan default dari tautan
                    event.preventDefault();
                });
            });
    
            // Mengatur tab terakhir yang aktif atau default ke tab Harian
            var activeTab = localStorage.getItem('activeTab') || '#tabHarian';
            activateTab(activeTab);
        });
    </script>
    
    <script>
            $('.date-picker').datepicker({
                dateFormat: "mm/yy",
                changeMonth: true,
                changeYear: true,
                showButtonPanel: true,
                onClose: function(dateText, inst) {


                    function isDonePressed() {
                        return ($('#ui-datepicker-div').html().indexOf(
                            'ui-datepicker-close ui-state-default ui-priority-primary ui-corner-all ui-state-hover'
                            ) > -1);
                    }

                    if (isDonePressed()) {
                        var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
                        var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
                        $(this).datepicker('setDate', new Date(year, month, 1)).trigger('change');

                        $('.date-picker')
                        .focusout() //Added to remove focus from datepicker input box on selecting date
                    }
                },
                beforeShow: function(input, inst) {

                    inst.dpDiv.addClass('month_year_datepicker')
                    if ((datestr = $(this).val()).length > 0) {
                        year = datestr.substring(datestr.length - 4, datestr.length);
                        month = datestr.substring(0, 2);
                        $(this).datepicker('option', 'defaultDate', new Date(year, month - 1, 1));
                        $(this).datepicker('setDate', new Date(year, month - 1, 1));
                        $(".ui-datepicker-calendar").hide();
                    }
                }
            });
    </script>
    <script>
        var ctx = document.getElementById('chartharian').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ["5 Hari yang lalu", "4 Hari yang lalu", "3 Hari yang lalu", "Kemarin", "Hari ini", ],
                datasets: [{
                        label: 'Parameter 1', // Name the series
                        data: ['40', '57'], // Specify the data values array
                        fill: false,
                        borderColor: '#ffd000', // Add custom color border (Line)
                        backgroundColor: '#ffd000', // Add custom color background (Points and Fill)
                        borderWidth: 3 // Specify bar border width
                    },

                ]
            },
            options: {
                responsive: true, // Instruct chart js to respond nicely.
                maintainAspectRatio: false, // Add to prevent default behaviour of full-width/height
                plugins: {
                    title: {
                        display: true,
                        text: 'Total Mw',
                        padding: {
                            top: 5,
                        }
                    }
                }
            }
        });
    </script>
@endpush
