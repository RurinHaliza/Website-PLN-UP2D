@extends('layouts.app')

@section('title', 'Beban Bulanan')

@push('style')
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Monitoring Scada Fail</h1>
            </div>
        </section>

        <div class="card mt-3">
            <div class="card-header">
                <h5 class="m-0 font-weight-bold text-primary">Tabel Pengukuran</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="table-1" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Feeder Pkey</th>
                                <th>Gardu</th>
                                <th>Feeder</th>
                                <th>Jam Tanggal</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @php
                                $no = 1;
                            @endphp

                            @foreach ($get as $g)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $g->feeder_pkey }}</td>
                                    <td>{{ $g->gardu_induk }}</td>
                                    <td>{{ $g->feeder }}</td>
                                    <td>{{ $g->tanggal }}</td>
                                    <td>
                                        <div class="badge badge-danger">{{ $g->status }}</div>
                                    </td>
                                    <td>
                                    
                                    @if (Auth::user()->hasRole('operator'))
                                    <a href="{{ route('editscadafail', [$g->feeder_pkey]) }}"
                                        class="btn btn-primary">Edit Data</a>
                                    @elseif (Auth::user()->hasRole('Administrator'))
                                    <a href="{{ route('editscadafail.admin', [$g->feeder_pkey]) }}"
                                        class="btn btn-primary">Edit Data</a>

                                    @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                <a href="{{ route('download.excel.adminGI') }}" class="btn btn-primary"><i
                        class="fas fa-fw fa-arrow-down"></i>Download Excel</a>
            </div>
        </div>

    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script>
        $("#table-1").dataTable({
            "columnDefs": [{
                "sortable": false,
                "targets": [2, 3]
            }]
        });
    </script>
@endpush
