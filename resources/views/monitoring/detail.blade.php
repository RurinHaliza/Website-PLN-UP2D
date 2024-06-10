@extends('layouts.app')

@section('title', 'Beban Bulanan')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <<div class="section-header">
                <h1>Highlight Kondisi Sistem</h1>
                <div class="card-body">
                </div>
    </div>
    <a href="{{ url()->previous() }}" class="btn btn-danger mb-4">Kembali</a>
    <div class="section-body">
        <div class="card">
            <div class="card-body">
                <div class="section-title mt-0">Monitoring</div>
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
                                <h5>Detail Beban</h5>
                            </div>
                            <div class="card-body p-0">
                                <div class="tickets-list">
                                    <a class="ticket-item">
                                        <div class="ticket-title">
                                            <h4>Beban Jatim Tertinggi {{ $selectedDate }}</h4>
                                        </div>
                                        <div class="ticket-info">
                                            @if (!empty($maxValueDay))
                                                <div>Ampere : {{ $maxValueDay }}</div>
                                            @else
                                                <div>Ampere :</div>
                                            @endif
                                        </div>
                                        <div class="ticket-info">
                                            @if (!empty($maxColumnDay))
                                                <div>Pukul : {{ $maxColumnDay }}</div>
                                            @else
                                                <div>Pukul : </div>
                                            @endif
                                        </div>
                                        <div class="ticket-info">
                                            @if (!empty($averageValueDay))
                                                <div>Rata-Rata : {{ $averageValueDay }}</div>
                                            @else
                                                <div>Rata-Rata : </div>
                                            @endif
                                        </div>
                                    </a>
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
                                        </div><br>
                                        <div class="ticket-info">
                                            @if ($maxValue2 > 0)
                                                <div>Tertinggi kedua : {{ $maxValue2 }}</div>
                                            @else
                                                <div>Tertinggi kedua :</div>
                                            @endif
                                        </div>
                                        <div class="ticket-info">
                                            @if ($maxValue2 > 0)
                                                <div>Pukul : {{ $maxColumn2 }}</div>
                                            @else
                                                <div>Pukul :</div>
                                            @endif
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
                                        </div><br>
                                        <div class="ticket-info">
                                            @if ($maxValueM2 > 0)
                                                <div>Tertinggi kedua : {{ $maxValueM2 }}</div>
                                            @else
                                                <div>Tertinggi kedua :</div>
                                            @endif
                                        </div>
                                        <div class="ticket-info">
                                            @if ($maxValueM2 > 0)
                                                <div>Pukul : {{ $maxColumnM2 }}</div>
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
                                    <div class="card-body"> @if (Auth::user()->hasRole('Administrator'))
                                        <form action="{{ route('detailbeban') }}" method="GET">
                                    @elseif (Auth::user()->hasRole('operator'))
                                        <form action="{{ route('detailbeban.operator') }}" method="GET">
                                    @elseif (Auth::user()->hasRole('ValidatorOpsis'))
                                        <form action="{{ route('detailbeban.opsis') }}" method="GET">
                                    @elseif (Auth::user()->hasRole('ValidatorFasop'))
                                        <form action="{{ route('detailbeban.validfasop') }}" method="GET">
                                    @elseif (Auth::user()->hasRole('EditorOpsis'))
                                        <form action="{{ route('detailbeban.editorop') }}" method="GET">
                                    @elseif (Auth::user()->hasRole('visitor'))
                                        <form action="{{ route('detailbeban.visitor') }}" method="GET">
                                    @elseif (Auth::user()->hasRole('Manager'))
                                        <form action="{{ route('detailbeban.manager') }}" method="GET">
                                    @endif
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
                                        <p>No results found for the selected date range.</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div style="width: 100%; height:170px; margin: auto;">
                                    <canvas id="chartharian"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}

            </div>
            <div class="tab-pane fade" id="tabMingguan">
                <div class="row">
                    <div class="col-md-3">
                        <div class="card card-hero">
                            <div class="card-header">
                                <div class="card-icon">
                                    <i class="far fa-question-circle"></i>
                                </div>
                                <h5>Detail Beban</h5>
                            </div>
                            <div class="card-body p-0">
                                <div class="tickets-list">
                                    <a class="ticket-item">
                                        <div class="ticket-title">
                                            <h4>Beban Jatim Tertinggi {{ $startDate }} dan {{ $endDate }}</h4>
                                        </div>
                                        <div class="ticket-info">
                                            @if (!empty($maxValueWeek))
                                                <div>Ampere : {{ $maxValueWeek }}</div>
                                            @else
                                                <div>Ampere :</div>
                                            @endif
                                        </div>
                                        <div class="ticket-info">
                                            @if (!empty($maxColumnWeek))
                                                <div>Tanggal : {{ $maxColumnWeek }}</div>
                                            @else
                                                <div>Tanggal : </div>
                                            @endif
                                        </div>
                                        <div class="ticket-info">
                                            @if (!empty($averageValueWeek))
                                                <div>Rata-Rata : {{ $averageValueWeek }}</div>
                                            @else
                                                <div>Rata-Rata : </div>
                                            @endif
                                        </div>
                                    </a>
                                    <a class="ticket-item">
                                        <div class="ticket-title">
                                            <h4>Beban Siang</h4>
                                        </div>
                                        <div class="ticket-info">
                                            @if ($maxValueSWeek > 0)
                                                <div>Tertinggi : {{ $maxValueSWeek }}</div>
                                            @else
                                                <div>Tertinggi :</div>
                                            @endif
                                        </div>
                                        <div class="ticket-info">
                                            @if ($maxColumnSWeek)
                                                <div>Pukul : {{ $maxColumnSWeek }}</div>
                                            @else
                                                <div>Pukul :</div>
                                            @endif
                                        </div>
                                        <div class="ticket-info">
                                            <div>Rata-Rata : {{ $averageValueSWeek }}</div>
                                        </div><br>
                                        <div class="ticket-info">
                                            @if ($maxValueSWeek2 > 0)
                                                <div>Tertinggi kedua : {{ $maxValueSWeek2 }}</div>
                                            @else
                                                <div>Tertinggi kedua :</div>
                                            @endif
                                        </div>
                                        <div class="ticket-info">
                                            @if ($maxColumnSWeek2)
                                                <div>Pukul : {{ $maxColumnSWeek2 }}</div>
                                            @else
                                                <div>Pukul :</div>
                                            @endif
                                        </div>
                                    </a>
                                    <a class="ticket-item">
                                        <div class="ticket-title">
                                            <h4>Beban Malam</h4>
                                        </div>
                                        <div class="ticket-info">
                                            @if ($maxValueMWeek > 0)
                                                <div>Tertinggi : {{ $maxValueMWeek }}</div>
                                            @else
                                                <div>Tertinggi :</div>
                                            @endif
                                        </div>
                                        <div class="ticket-info">
                                            @if ($maxColumnMWeek)
                                                <div>Pukul : {{ $maxColumnMWeek }}</div>
                                            @else
                                                <div>Pukul :</div>
                                            @endif
                                        </div>
                                        <div class="ticket-info">
                                            <div>Rata-Rata : {{ $averageValueMWeek }}</div>
                                        </div><br>
                                        <div class="ticket-info">
                                            @if ($maxValueMWeek2 > 0)
                                                <div>Tertinggi kedua : {{ $maxValueMWeek2 }}</div>
                                            @else
                                                <div>Tertinggi kedua :</div>
                                            @endif
                                        </div>
                                        <div class="ticket-info">
                                            @if ($maxColumnMWeek2)
                                                <div>Pukul : {{ $maxColumnMWeek2 }}</div>
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
                                <h4>Simple Table</h4>
                                <div class="card-body">
                                    @if (Auth::user()->hasRole('Administrator'))
                                        <form action="{{ route('detailbeban') }}" method="GET">
                                    @elseif (Auth::user()->hasRole('operator'))
                                        <form action="{{ route('detailbeban.operator') }}" method="GET">
                                    @elseif (Auth::user()->hasRole('ValidatorOpsis'))
                                        <form action="{{ route('detailbeban.opsis') }}" method="GET">
                                    @elseif (Auth::user()->hasRole('ValidatorFasop'))
                                        <form action="{{ route('detailbeban.validfasop') }}" method="GET">
                                    @elseif (Auth::user()->hasRole('EditorOpsis'))
                                        <form action="{{ route('detailbeban.editorop') }}" method="GET">
                                    @elseif (Auth::user()->hasRole('visitor'))
                                        <form action="{{ route('detailbeban.visitor') }}" method="GET">
                                    @elseif (Auth::user()->hasRole('Manager'))
                                        <form action="{{ route('detailbeban.manager') }}" method="GET">
                                    @endif
                                        <div class="row">
                                            <div class="col-md-4">
                                                <input type="date" name="start_date" class="form-control"
                                                    value="{{ $startDate }}">
                                            </div>
                                            <div class="col-md-4">
                                                <input type="date" name="end_date" class="form-control"
                                                    value="{{ $endDate }}">
                                            </div>
                                            <div class="col-md-4">
                                                <button class="btn btn-primary" type="submit"><i
                                                        class="fas fa-2x fa-search"></i><span>Cari</span></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    @if ($processedResults->isEmpty())
                                        <p>No results found for the selected date range.</p>
                                    @else
                                        <table id="bebantrafo" class="table-bordered table-md table">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Feeder PKey</th>
                                                    <th>Gardu Induk</th>
                                                    <th>Incoming</th>
                                                    <th>Name</th>
                                                    <th>Bulan</th>
                                                    @for ($day = $startDay; $day <= $endDay; $day++)
                                                        <th>{{ str_pad($day, 2, '0', STR_PAD_LEFT) }}_S</th>
                                                        <th>{{ str_pad($day, 2, '0', STR_PAD_LEFT) }}_M</th>
                                                    @endfor
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($processedResults as $result)
                                                    <tr>
                                                        <td>{{ $result->id }}</td>
                                                        <td>{{ $result->feeder_pkey }}</td>
                                                        <td>{{ $result->gardu_induk }}</td>
                                                        <td>{{ $result->incoming }}</td>
                                                        <td>{{ $result->name }}</td>
                                                        <td>{{ $result->bulan }}</td>
                                                        @for ($day = $startDay; $day <= $endDay; $day++)
                                                            <td>{{ $result->{str_pad($day, 2, '0', STR_PAD_LEFT) . '_S'} }}
                                                            </td>
                                                            <td>{{ $result->{str_pad($day, 2, '0', STR_PAD_LEFT) . '_M'} }}
                                                            </td>
                                                        @endfor
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h4>Grafik Beban Mingguan</h4>
                            </div>
                            <div class="card-body">
                                <canvas id="bebanChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div style="width: 100%; height:170px; margin: auto;">
                                    <canvas id="bebanChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
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
                                <h5>Detail Beban</h5>
                            </div>
                            <div class="card-body p-0">
                                <div class="tickets-list">
                                    <a class="ticket-item">
                                        <div class="ticket-title">
                                            <h4>Beban Jatim Tertinggi {{ $StartBulan1 }}</h4>
                                        </div>
                                        <div class="ticket-info">
                                            @if (!empty($StartBulan1))
                                                <div>Ampere : {{ $maxValueMonthly }}</div>
                                            @else
                                                <div>Ampere :</div>
                                            @endif
                                        </div>
                                        <div class="ticket-info">
                                            @if (!empty($StartBulan1))
                                                <div>Tanggal : {{ $maxColumnMonthly }}</div>
                                            @else
                                                <div>Tanggal : </div>
                                            @endif
                                        </div>
                                        <div class="ticket-info">
                                            @if (!empty($StartBulan1))
                                                <div>Rata-Rata : {{ $averageValueMonthly }}</div>
                                            @else
                                                <div>Rata-Rata : </div>
                                            @endif
                                        </div>
                                    </a>
                                    <a class="ticket-item">
                                        <div class="ticket-title">
                                            <h4>Beban Siang</h4>
                                        </div>
                                        <div class="ticket-info">
                                            @if ($StartBulan1 > 0)
                                                <div>Tertinggi : {{ $maxValueSMonth }}</div>
                                            @else
                                                <div>Tertinggi :</div>
                                            @endif
                                        </div>
                                        <div class="ticket-info">
                                            @if ($StartBulan1 > 0)
                                                <div>Pukul : {{ $maxColumnSMonth }}</div>
                                            @else
                                                <div>Pukul :</div>
                                            @endif
                                        </div>
                                        <div class="ticket-info">
                                            <div>Rata-Rata : {{ $averageValueSMonth }}</div>
                                        </div><br>
                                        <div class="ticket-info">
                                            @if ($StartBulan1 > 0)
                                                <div>Tertinggi : {{ $maxValueSMonth2 }}</div>
                                            @else
                                                <div>Tertinggi :</div>
                                            @endif
                                        </div>
                                        <div class="ticket-info">
                                            @if ($StartBulan1 > 0)
                                                <div>Pukul : {{ $maxColumnSMonth2 }}</div>
                                            @else
                                                <div>Pukul :</div>
                                            @endif
                                        </div>
                                    </a>
                                    <a class="ticket-item">
                                        <div class="ticket-title">
                                            <h4>Beban Malam</h4>
                                        </div>
                                        <div class="ticket-info">
                                            @if ($StartBulan1 > 0)
                                                <div>Tertinggi : {{ $maxValueMMonth }}</div>
                                            @else
                                                <div>Tertinggi :</div>
                                            @endif
                                        </div>
                                        <div class="ticket-info">
                                            @if ($maxColumnMMonth > 0)
                                                <div>Pukul : {{ $maxColumnMMonth }}</div>
                                            @else
                                                <div>Pukul :</div>
                                            @endif
                                        </div>
                                        <div class="ticket-info">
                                            <div>Rata-Rata : {{ $averageValueMMonth }}</div>
                                        </div><br>
                                        <div class="ticket-info">
                                            @if ($StartBulan1 > 0)
                                                <div>Tertinggi : {{ $maxValueMMonth2 }}</div>
                                            @else
                                                <div>Tertinggi :</div>
                                            @endif
                                        </div>
                                        <div class="ticket-info">
                                            @if ($maxColumnMMonth > 0)
                                                <div>Pukul : {{ $maxColumnMMonth2 }}</div>
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
                                        @if (Auth::user()->hasRole('Administrator'))
                                        <form action="{{ route('detailbeban') }}" method="GET">
                                    @elseif (Auth::user()->hasRole('operator'))
                                        <form action="{{ route('detailbeban.operator') }}" method="GET">
                                    @elseif (Auth::user()->hasRole('ValidatorOpsis'))
                                        <form action="{{ route('detailbeban.opsis') }}" method="GET">
                                    @elseif (Auth::user()->hasRole('ValidatorFasop'))
                                        <form action="{{ route('detailbeban.validfasop') }}" method="GET">
                                    @elseif (Auth::user()->hasRole('EditorOpsis'))
                                        <form action="{{ route('detailbeban.editorop') }}" method="GET">
                                    @elseif (Auth::user()->hasRole('visitor'))
                                        <form action="{{ route('detailbeban.visitor') }}" method="GET">
                                    @elseif (Auth::user()->hasRole('Manager'))
                                        <form action="{{ route('detailbeban.manager') }}" method="GET">
                                    @endif
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
                                    @if ($processedResultsMonth->isEmpty())
                                        <p>No results found for the selected date range.</p>
                                    @else
                                        <table id="bebantrafo" class="table-bordered table-md table">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Feeder PKey</th>
                                                    <th>Gardu Induk</th>
                                                    <th>Incoming</th>
                                                    <th>Name</th>
                                                    <th>Bulan</th>
                                                    @for ($day = 1; $day <= 31; $day++)
                                                        <th>{{ str_pad($day, 2, '0', STR_PAD_LEFT) }}_S</th>
                                                        <th>{{ str_pad($day, 2, '0', STR_PAD_LEFT) }}_M</th>
                                                    @endfor
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($processedResultsMonth as $result)
                                                    <tr>
                                                        <td>{{ $result->id }}</td>
                                                        <td>{{ $result->feeder_pkey }}</td>
                                                        <td>{{ $result->gardu_induk }}</td>
                                                        <td>{{ $result->incoming }}</td>
                                                        <td>{{ $result->name }}</td>
                                                        <td>{{ $result->bulan }}</td>
                                                        @for ($day = 1; $day <= 31; $day++)
                                                            <td>{{ $result->{str_pad($day, 2, '0', STR_PAD_LEFT) . '_S'} }}
                                                            </td>
                                                            <td>{{ $result->{str_pad($day, 2, '0', STR_PAD_LEFT) . '_M'} }}
                                                            </td>
                                                        @endfor
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h4>Grafik Beban Bulanan</h4>
                            </div>
                            <div class="card-body">
                                <canvas id="bebanChart2"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="tab-pane fade" id="tabTahunan">
                <!-- Konten untuk tab Tahunan -->
                <div class="row">
                    <div class="col-md-3">
                        <div class="card card-hero">
                            <div class="card-header">
                                <div class="card-icon">
                                    <i class="far fa-question-circle"></i>
                                </div>
                                <h5>Detail Beban</h5>
                            </div>
                            <div class="card-body p-0">
                                <div class="tickets-list">
                                    <a class="ticket-item">
                                        <div class="ticket-title">
                                            <h4>Beban Jatim Tertinggi {{ $startDate }} dan {{ $endDate }}</h4>
                                        </div>
                                        <div class="ticket-info">
                                            @if (!empty($maxValue))
                                                <div>Ampere : {{ $maxValue }}</div>
                                            @else
                                                <div>Ampere :</div>
                                            @endif
                                        </div>
                                        <div class="ticket-info">
                                            @if (!empty($maxColumn))
                                                <div>Tanggal : {{ $maxColumn }}</div>
                                            @else
                                                <div>Tanggal : </div>
                                            @endif
                                        </div>
                                        <div class="ticket-info">
                                            @if (!empty($averageValue))
                                                <div>Rata-Rata : {{ $averageValue }}</div>
                                            @else
                                                <div>Rata-Rata : </div>
                                            @endif
                                        </div>
                                    </a>
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

                    <div class="col-12 col-md-9 col-lg-9">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-header">
                                    <h4>Simple Table</h4>
                                    <div class="card-body">
                                        {{-- <form action="{{ route('detailbeban') }}" method="GET">
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
                                        </form> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                {{-- <div class="table-responsive">
                                    @if ($processedResultsMonth->isEmpty())
                                        <p>Tidak ada data untuk bulan {{ $StartBulan1 }}</p>
                                    @else
                                        <table id="bebantrafo" class="table-bordered table-md table">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Feeder PKey</th>
                                                    <th>Gardu Induk</th>
                                                    <th>Incoming</th>
                                                    <th>Name</th>
                                                    <th>Bulan</th>
                                                    @for ($day = 1; $day <= 31; $day++)
                                                        <th>{{ str_pad($day, 2, '0', STR_PAD_LEFT) }}</th>
                                                    @endfor
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($processedResultsMonth as $result)
                                                    <tr>
                                                        <td>{{ $result->id }}</td>
                                                        <td>{{ $result->feeder_pkey }}</td>
                                                        <td>{{ $result->gardu_induk }}</td>
                                                        <td>{{ $result->incoming }}</td>
                                                        <td>{{ $result->name }}</td>
                                                        <td>{{ $result->bulan }}</td>
                                                        @for ($day = 1; $day <= 31; $day++)
                                                            <td>{{ $result->{str_pad($day, 2, '0', STR_PAD_LEFT)} }}</td>
                                                        @endfor
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    @endif
                                </div> --}}
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
    <!-- JS Libraries -->
    <script src="{{ asset('library/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('library/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('library/summernote/dist/summernote-bs4.min.js') }}"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
    <script>
        $("#jumlahfeederup3").dataTable({});
    </script>

    {{-- <script>
        $(function() {
    $('#bebantrafo').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
        "buttons": [ // Menambahkan bagian ini untuk menentukan tombol ekspor
            'excel', // Tombol untuk mengekspor ke Excel
            'pdf', // Tombol untuk mengekspor ke PDF
            'print' // Tombol untuk mencetak tabel
        ]
    }).buttons().container().appendTo('#bebantrafo .col-md-6:eq(0)'); // Ini akan menempatkan tombol-tombol ekspor ke dalam container yang diinginkan
});
    </script> --}}
    <script>
        $("#bebantrafo").dataTable({
        "paging": true,
        "lengthChange": false,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
        "dom": 'Bfrtip', // Menambahkan dom untuk tombol ekspor
        "buttons": [ // Menambahkan tombol ekspor
            'excel',
            'pdf',
            'print'
        ]
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
    {{-- <script>
        $(document).ready(function() {
            $('.date-picker').datepicker({
                dateFormat: "mm",
                changeMonth: true,
                changeYear: false,
                showButtonPanel: true,
                closeText: 'Done',
                onClose: function(dateText, inst) {
                    function isDonePressed() {
                        return $('#ui-datepicker-div .ui-datepicker-close').hasClass('ui-state-hover');
                    }
                    if (isDonePressed()) {
                        var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
                        var monthNames = ["January", "February", "March", "April", "May", "June",
                            "July", "August", "September", "October", "November", "December"
                        ];
                        var monthName = monthNames[month];
                        $(this).val(monthName).trigger('change');
                    }
                },
                beforeShow: function(input, inst) {
                    setTimeout(function() {
                        $(".ui-datepicker-calendar").hide();
                    }, 0);

                    if ((datestr = $(input).val()).length > 0) {
                        var monthNames = ["January", "February", "March", "April", "May", "June",
                            "July", "August", "September", "October", "November", "December"
                        ];
                        var monthName = datestr;
                        var month = monthNames.indexOf(monthName);
                        if (month !== -1) {
                            $(input).datepicker('option', 'defaultDate', new Date(0, month, 1));
                            $(input).datepicker('setDate', new Date(0, month, 1));
                        }
                    }
                },
                onChangeMonthYear: function(year, month, inst) {
                    setTimeout(function() {
                        $(".ui-datepicker-calendar").hide();
                    }, 0);
                }
            });
        });
    </script> --}}
    <script>
        $(document).ready(function() {
    

    $('.date-picker').datepicker({
        dateFormat: "mm",
        changeMonth: true,
        changeYear: false,
        showButtonPanel: true,
        closeText: 'Done',
        onClose: function(dateText, inst) {
            function isDonePressed() {
                return $('#ui-datepicker-div .ui-datepicker-close').hasClass('ui-state-hover');
            }
            if (isDonePressed()) {
                var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
                var monthNames = ["January", "February", "March", "April", "May", "June",
                    "July", "August", "September", "October", "November", "December"
                ];
                var monthName = monthNames[month];
                $(this).val(monthName).trigger('change');
            }
        },
        beforeShow: function(input, inst) {
            setTimeout(function() {
                $(".ui-datepicker-calendar").hide();
            }, 0);

            if ((datestr = $(input).val()).length > 0) {
                var monthNames = ["January", "February", "March", "April", "May", "June",
                    "July", "August", "September", "October", "November", "December"
                ];
                var monthName = datestr;
                var month = monthNames.indexOf(monthName);
                if (month !== -1) {
                    $(input).datepicker('option', 'defaultDate', new Date(0, month, 1));
                    $(input).datepicker('setDate', new Date(0, month, 1));
                }
            }
        },
        onChangeMonthYear: function(year, month, inst) {
            setTimeout(function() {
                $(".ui-datepicker-calendar").hide();
            }, 0);
        }
    }).on('change', function() {
        var datepickerInput = this;
        if (table.search() !== datepickerInput.value) {
            table.search(datepickerInput.value).draw();
        }
    });

    // Menonaktifkan datepicker saat pencarian aktif
    table.on('search.dt', function() {
        $('.date-picker').datepicker("disable");
    });

    // Mengaktifkan kembali datepicker setelah pencarian selesai
    table.on('draw.dt', function() {
        $('.date-picker').datepicker("enable");
    });
});

    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var ctx = document.getElementById('bebanChart').getContext('2d');
            var bebanChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: {!! json_encode(array_values($maxColumns)) !!}, // Labels are the days
                    datasets: [{
                        label: 'Nilai Tertinggi',
                        data: {!! json_encode(array_values($maxValues)) !!}, // Data points are the max values per day
                        borderColor: 'rgba(75, 192, 192, 1)',
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        fill: false,
                        tension: 0.1
                    }]
                },
                options: {
                    scales: {
                        x: {
                            title: {
                                display: true,
                                text: 'Tanggal', // Description for X axis
                                color: '#911',
                                font: {
                                    family: 'Comic Sans MS',
                                    size: 20,
                                    weight: 'bold',
                                    lineHeight: 1.2
                                },
                                padding: {
                                    top: 20,
                                    left: 0,
                                    right: 0,
                                    bottom: 0
                                }
                            }
                        },
                        y: {
                            title: {
                                display: true,
                                text: 'Nilai Tertinggi', // Description for Y axis
                                color: '#191',
                                font: {
                                    family: 'Times',
                                    size: 20,
                                    style: 'italic',
                                    lineHeight: 1.2
                                },
                                padding: {
                                    top: 0,
                                    left: 0,
                                    right: 0,
                                    bottom: 20
                                }
                            },
                            beginAtZero: true
                        }
                    },
                    plugins: {
                        legend: {
                            display: true,
                            labels: {
                                color: 'rgb(255, 99, 132)'
                            }
                        },
                        tooltip: {
                            enabled: true
                        }
                    }
                }
            });
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var ctx = document.getElementById('bebanChart2').getContext('2d');
            var bebanChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: {!! json_encode(array_values($maxColumnsMonth)) !!}, // Labels are the days
                    datasets: [{
                        label: 'Nilai Tertinggi',
                        data: {!! json_encode(array_values($maxValuesMonth)) !!}, // Data points are the max values per day
                        borderColor: 'rgba(75, 192, 192, 1)',
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        fill: false,
                        tension: 0.1
                    }]
                },
                options: {
                    scales: {
                        x: {
                            title: {
                                display: true,
                                text: 'Tanggal', // Description for X axis
                                color: '#911',
                                font: {
                                    family: 'Comic Sans MS',
                                    size: 20,
                                    weight: 'bold',
                                    lineHeight: 1.2
                                },
                                padding: {
                                    top: 20,
                                    left: 0,
                                    right: 0,
                                    bottom: 0
                                }
                            }
                        },
                        y: {
                            title: {
                                display: true,
                                text: 'Nilai Tertinggi', // Description for Y axis
                                color: '#191',
                                font: {
                                    family: 'Times',
                                    size: 20,
                                    style: 'italic',
                                    lineHeight: 1.2
                                },
                                padding: {
                                    top: 0,
                                    left: 0,
                                    right: 0,
                                    bottom: 20
                                }
                            },
                            beginAtZero: true
                        }
                    },
                    plugins: {
                        legend: {
                            display: true,
                            labels: {
                                color: 'rgb(255, 99, 132)'
                            }
                        },
                        tooltip: {
                            enabled: true
                        }
                    }
                }
            });
        });
    </script>
@endpush
