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
            @if(session('message'))
            <div class="alert alert-success">
                {{session('message')}}
            </div>
            @endif
            <div class="section-body">
                <h2 class="section-title">List User</h2>
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h4>User</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table-bordered table-md table">
                                    
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                        </tr>
                                        @forelse ($users as $user)
                                        <tr>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->role }}</td>
                                        </tr>
                                        @csrf
                                        @empty
                                  <div class="alert alert-danger">
                                      Data Post belum Tersedia.
                                  </div>
                              @endforelse
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6">
                        <div class="card">
                            <form action="{{route('actionregister')}}" method="post" class="needs-validation"
                                novalidate="">
                                @csrf
                                <div class="card-header">
                                    <h4>Create User</h4>
                                </div>
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Name</label>
                                        <div class="col-sm-9">
                                        <input id="name"
                                            type="text"
                                            class="form-control"
                                            name="name"
                                            autofocus>
                                            <div class="invalid-feedback">
                                                What's your name?
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Email</label>
                                        <div class="col-sm-9">
                                        <input id="email"
                                        type="email"
                                        class="form-control"
                                        name="email">
                                            <div class="invalid-feedback">
                                                Oh no! Email is invalid.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Password</label>
                                        <div class="col-sm-9">
                                        <input id="password"
                                            type="password"
                                            class="form-control pwstrength"
                                            data-indicator="pwindicator"
                                            name="password">
                                            <div class="invalid-feedback">
                                                Oh no! Password is invalid.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-0">
                                        <label class="col-sm-3 col-form-label">Role</label>
                                        <div class="col-sm-9">
                                        <select  id="role" name="role" class="form-control selectric">
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->name }}">{{ $role->name }}</option>
                                        @endforeach
                                        </select>
                                            <div class="invalid-feedback">
                                                What do you wanna say?
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                    <button class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div> 

        </section>
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
