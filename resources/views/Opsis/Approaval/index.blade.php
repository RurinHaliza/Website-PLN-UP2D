@extends('layouts.app')

@section('title', 'Beban Bulanan')

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
                <h1>Approval Scada Fail</h1>
            </div>
        </section>

        <div class="card mt-3">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="approval" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Tanggal</th>
                                <th>Gardu</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
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
    <!-- JS Libraies -->

    <script>
        $("#approval").dataTable({
            "columnDefs": [{
                "sortable": false,
                "targets": [2, 3]
            }]
        });
    </script>

@endpush
