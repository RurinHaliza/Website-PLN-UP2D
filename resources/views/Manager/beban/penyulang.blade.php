@extends('layouts.app')

@section('title', 'Penyulang Jatim')

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
                <h1>Beban Penyulang</h1>
            </div>
        </section>
        <div class="card mt-3">
            <div class="card-header">
                <h5 class="m-0 font-weight-bold text-primary">Tabel Pengukuran</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="penyulang" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>ID JTM</th>
                                <th>ID GI</th>
                                <th>ID TRAFO GI</th>
                                <th>NM JTM</th>
                                <th>NM GI</th>
                                <th>NM Singkatan</th>
                                <th>UP3</th>
                                <th>ULP</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @php
                                $no = 1;
                            @endphp

                            @foreach($penyulang as $p)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $p->ID_JTM }}</td>
                                    <td>{{ $p->ID_GI }}</td>
                                    <td>{{ $p->ID_TRAFOGI }}</td>
                                    <td>{{ $p->NM_JTM }}</td>
                                    <td>{{ $p->NM_GI }}</td>
                                    <td>{{ $p->NM_SINGKATAN }}</td>
                                    <td>{{ $p->UP3 }}</td>
                                    <td>{{ $p->ULP }}</td>   
                                    <td><a href="{{ route('detail.penyulang.manager',[$p->id]) }}" class="btn btn-primary">Detail</a></td>                           
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-primary"><i class="fas fa-fw fa-arrow-down"></i>Download Excel</button>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    $("#penyulang").dataTable({
        "columnDefs": [{
            "sortable": false,
            "targets": [2, 3]
        }]
    });
</script>
@endpush
