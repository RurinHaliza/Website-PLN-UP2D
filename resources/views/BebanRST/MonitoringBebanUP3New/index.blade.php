@extends('layouts.app')

@section('title', 'Monitoring Beban UP3 New')

@push('style')
    <!-- Library CSS -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('library/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.min.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/rowgroup/1.1.0/css/rowGroup.dataTables.min.css">

    <!-- Bootstrap & FontAwesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Monitoring Detail Beban UP3 New</h1>
            </div>
        </section>

        <a href="{{ url()->previous() }}" class="btn btn-danger mb-4">Kembali</a>
        <a href="{{ route('data.bebanup3new') }}" class="btn btn-success mb-4">Detail Beban UP3 New</a>

        <div class="dashboard-container">
            <!-- Header Section -->
            <div class="header-section text-center">
                <h1>PLN UP2D JATIM</h1>
                <h2>DASHBOARD MONITORING BEBAN LISTRIK JAWA TIMUR</h2>
            </div>
            <!-- ROW 3: SUMMARY -->
            <div class="row row-spacing">
                <div class="col-lg-3 col-md-6">
                    <div class="card summary-card card-primary">
                        <div class="card-header text-white text-center"><i class="fas fa-sun me-2"></i>Max Siang</div>
                        <div class="card-body">
                            <h3 id="maxSiangValue"></h3><small>Ampere</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card summary-card card-success">
                        <div class="card-header text-white text-center"><i class="fas fa-moon me-2"></i>Max Malam</div>
                        <div class="card-body">
                            <h3 id="maxMalamValue"></h3><small>Ampere</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card summary-card card-warning">
                        <div class="card-header text-white text-center"><i class="fas fa-chart-line me-2"></i>Avg Siang
                        </div>
                        <div class="card-body">
                            <h3 id="avgSiangValue"></h3><small>Ampere</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card summary-card card-danger">
                        <div class="card-header text-white text-center"><i class="fas fa-chart-bar me-2"></i>Avg Malam</div>
                        <div class="card-body">
                            <h3 id="avgMalamValue"></h3><small>Ampere</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ROW 1: BEBAN JATIM TERTINGGI -->
        <div class="row row-spacing">
            <!-- Hari Ini -->
            <div class="col-lg-4 col-md-6">
                <div class="card stat-card card-success">
                    <div class="card-header text-center">
                        <h4 style="color:white">
                            <i class="fas fa-sun"></i>
                            Total Penyulang Tertinggi
                            <span class="period-indicator period-today">Hari Ini</span>
                        </h4>
                    </div>
                    <div class="card-body">
                        <ul class="stat-list">
                            <li><span class="stat-label">A</span><span class="stat-value highlight-value"
                                    id="totalPenyulangTodayMW">-</span></li>
                            <li><span class="stat-label">Tanggal</span><span class="stat-value"
                                    id="totalPenyulangTodayTanggal">-</span></li>
                            <li><span class="stat-label">Pukul</span><span class="stat-value" id="totalPenyulangTodayWaktu">-</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Minggu Ini -->
            <div class="col-lg-4 col-md-6">
                <div class="card stat-card card-success">
                    <div class="card-header text-center">
                        <h4 style="color:white">
                            <i class="fas fa-calendar-week"></i>
                            Total Penyulang Tertinggi
                            <span class="period-indicator period-week">Minggu Ini</span>
                        </h4>
                    </div>
                    <div class="card-body">
                        <ul class="stat-list">
                            <li><span class="stat-label">A</span><span class="stat-value highlight-value"
                                    id="totalPenyulangWeekMW">-</span></li>
                            <li><span class="stat-label">Tanggal</span><span class="stat-value"
                                    id="totalPenyulangWeekTanggal">-</span></li>
                            <li><span class="stat-label">Pukul</span><span class="stat-value" id="totalPenyulangWeekWaktu">-</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>


            <!-- Bulan Ini -->
            <div class="col-lg-4 col-md-6">
                <div class="card stat-card card-success">
                    <div class="card-header text-center">
                        <h4 style="color:white">
                            <i class="fas fa-calendar-alt"></i>
                            Total Penyulang Tertinggi
                            <span class="period-indicator period-month">Bulan Ini</span>
                        </h4>
                    </div>
                    <div class="card-body">
                        <ul class="stat-list">
                            <li><span class="stat-label">A</span><span class="stat-value highlight-value"
                                    id="totalPenyulangMonthMW">-</span></li>
                            <li><span class="stat-label">Tanggal</span><span class="stat-value"
                                    id="totalPenyulangMonthTanggal">-</span></li>
                            <li><span class="stat-label">Pukul</span><span class="stat-value" id="totalPenyulangMonthWaktu">-</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- ROW 2: BEBAN PENYULANG TERTINGGI -->
        <div class="row row-spacing">
            <!-- Hari Ini -->
            <div class="col-lg-4 col-md-6">
                <div class="card stat-card card-primary">
                    <div class="card-header text-center">
                        <h4 style="color:white">
                            <i class="fas fa-sun"></i>
                            Beban Penyulang Tertinggi
                            <span class="period-indicator period-today">Hari Ini</span>
                        </h4>
                    </div>
                    <div class="card-body">
                        <ul class="stat-list">
                            <li><span class="stat-label">Ampere</span><span class="stat-value highlight-value"
                                    id="ampereHarian">-</span></li>
                            <li><span class="stat-label">Tanggal</span><span class="stat-value" id="tanggalHarian">-</span>
                            </li>
                            <li><span class="stat-label">Pukul</span><span class="stat-value" id="pukulHarian">-</span></li>
                            <li><span class="stat-label">UP3</span><span class="stat-value" id="up3Harian">-</span></li>
                            <li><span class="stat-label">Gardu Induk</span><span class="stat-value"
                                    id="garduHarian">-</span></li>
                            <li><span class="stat-label">Feeder</span><span class="stat-value" id="feederHarian">-</span>
                            </li>
                            <li><span class="stat-label">Name</span><span class="stat-value" id="nameHarian">-</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Minggu Ini -->
            <div class="col-lg-4 col-md-6">
                <div class="card stat-card card-primary">
                    <div class="card-header text-center">
                        <h4 style="color:white">
                            <i class="fas fa-calendar-week"></i>
                            Beban Penyulang Tertinggi
                            <span class="period-indicator period-week">Minggu Ini</span>
                        </h4>
                    </div>
                    <div class="card-body">
                        <ul class="stat-list">
                            <li><span class="stat-label">Ampere</span><span class="stat-value highlight-value"
                                    id="ampereMingguan">-</span></li>
                            <li><span class="stat-label">Tanggal</span><span class="stat-value"
                                    id="tanggalMingguan">-</span></li>
                            <li><span class="stat-label">Pukul</span><span class="stat-value" id="pukulMingguan">-</span>
                            </li>
                            <li><span class="stat-label">UP3</span><span class="stat-value" id="up3Mingguan">-</span></li>
                            <li><span class="stat-label">Gardu Induk</span><span class="stat-value"
                                    id="garduMingguan">-</span></li>
                            <li><span class="stat-label">Feeder</span><span class="stat-value" id="feederMingguan">-</span>
                            </li>
                            <li><span class="stat-label">Name</span><span class="stat-value" id="nameMingguan">-</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Bulan Ini -->
            <div class="col-lg-4 col-md-6">
                <div class="card stat-card card-primary">
                    <div class="card-header text-center">
                        <h4 style="color:white">
                            <i class="fas fa-calendar-alt"></i>
                            Beban Penyulang Tertinggi
                            <span class="period-indicator period-month">Bulan Ini</span>
                        </h4>
                    </div>
                    <div class="card-body">
                        <ul class="stat-list">
                            <li><span class="stat-label">Ampere</span><span class="stat-value highlight-value"
                                    id="ampereBulanan">-</span></li>
                            <li><span class="stat-label">Tanggal</span><span class="stat-value" id="tanggalBulanan">-</span>
                            </li>
                            <li><span class="stat-label">Pukul</span><span class="stat-value" id="pukulBulanan">-</span>
                            </li>
                            <li><span class="stat-label">UP3</span><span class="stat-value" id="up3Bulanan">-</span></li>
                            <li><span class="stat-label">Gardu Induk</span><span class="stat-value"
                                    id="garduBulanan">-</span></li>
                            <li><span class="stat-label">Feeder</span><span class="stat-value" id="feederBulanan">-</span>
                            </li>
                            <li><span class="stat-label">Name</span><span class="stat-value" id="nameBulanan">-</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function () {

            // Jalankan pertama kali saat halaman dimuat
            loadMaxValues();
            fetchBebanJatim();
            updateBebanPenyulang();

            // Update semua fungsi setiap 5 menit (300000 ms)
            setInterval(() => {
                loadMaxValues();
                fetchBebanJatim()
                updateBebanPenyulang();
            }, 300000);

            function fetchBebanJatim() {
                const periodeList = [
                    { periode: "harian", mw: "totalPenyulangTodayMW", tanggal: "totalPenyulangTodayTanggal", waktu: "totalPenyulangTodayWaktu" },
                    { periode: "mingguan", mw: "totalPenyulangWeekMW", tanggal: "totalPenyulangWeekTanggal", waktu: "totalPenyulangWeekWaktu" },
                    { periode: "bulanan", mw: "totalPenyulangMonthMW", tanggal: "totalPenyulangMonthTanggal", waktu: "totalPenyulangMonthWaktu" }
                ];

                periodeList.forEach(item => {
                    fetch(`/total-penyulang-tertinggi?periode=${item.periode}`)
                        .then(response => response.json())
                        .then(data => {
                            document.getElementById(item.mw).innerText = Number(data.nilai_max).toLocaleString("id-ID");
                            document.getElementById(item.tanggal).innerText = data.tanggal || "-";
                            document.getElementById(item.waktu).innerText = data.waktu_max || "-";
                        })
                        .catch(error => console.error(`Error total penyulang ${item.periode}:`, error));
                });
            }

            async function loadMaxValues() {
                try {
                    const response = await fetch('/api/max-values');
                    const data = await response.json();
                    document.getElementById('maxSiangValue').textContent = data.maxSiang ?? '-';
                    document.getElementById('maxMalamValue').textContent = data.maxMalam ?? '-';
                    document.getElementById('avgSiangValue').textContent = data.avgSiang ?? '-';
                    document.getElementById('avgMalamValue').textContent = data.avgMalam ?? '-';
                } catch (error) {
                    console.error('Gagal memuat data:', error);
                }
            }

            function updateBebanPenyulang() {
                fetch("/beban-penyulang-tertinggi")
                    .then(response => response.json())
                    .then(data => {
                        // Harian
                        if (data.harian) {
                            document.getElementById("ampereHarian").innerText = data.harian.nilai_max + " A";
                            document.getElementById("tanggalHarian").innerText = data.harian.tanggal;
                            document.getElementById("pukulHarian").innerText = data.harian.waktu_max + " WIB";
                            document.getElementById("up3Harian").innerText = data.harian.up3;
                            document.getElementById("garduHarian").innerText = data.harian.gardu_induk;
                            document.getElementById("feederHarian").innerText = data.harian.feeder_asal;
                            document.getElementById("nameHarian").innerText = data.harian.name;
                        }

                        // Mingguan
                        if (data.mingguan) {
                            document.getElementById("ampereMingguan").innerText = data.mingguan.nilai_max + " A";
                            document.getElementById("tanggalMingguan").innerText = data.mingguan.tanggal;
                            document.getElementById("pukulMingguan").innerText = data.mingguan.waktu_max + " WIB";
                            document.getElementById("up3Mingguan").innerText = data.mingguan.up3;
                            document.getElementById("garduMingguan").innerText = data.mingguan.gardu_induk;
                            document.getElementById("feederMingguan").innerText = data.mingguan.feeder_asal;
                            document.getElementById("nameMingguan").innerText = data.mingguan.name;
                        }

                        // Bulanan
                        if (data.bulanan) {
                            document.getElementById("ampereBulanan").innerText = data.bulanan.nilai_max + " A";
                            document.getElementById("tanggalBulanan").innerText = data.bulanan.tanggal;
                            document.getElementById("pukulBulanan").innerText = data.bulanan.waktu_max + " WIB";
                            document.getElementById("up3Bulanan").innerText = data.bulanan.up3;
                            document.getElementById("garduBulanan").innerText = data.bulanan.gardu_induk;
                            document.getElementById("feederBulanan").innerText = data.bulanan.feeder_asal;
                            document.getElementById("nameBulanan").innerText = data.bulanan.name;
                        }
                    })
                    .catch(err => console.error("Gagal memuat data beban penyulang:", err));
            }

        });
    </script>
@endpush