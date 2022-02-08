@extends('layout.layout')
@section('content')
<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Ganti Password</h1>
                                    </div>
                                    <form action="{{ route('gantipassword') }}" method="post">
                                            @csrf
                                            <div class="card-body">
                                                @if(session('errors'))
                                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                        Something it's wrong:
                                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                        <ul>
                                                        @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                        @endforeach
                                                        </ul>
                                                    </div>
                                                @endif
                                                <input type="hidden" name="id" id="id" value="{{Auth::user()->id}}">
                                                <div class="form-group">
                                                    <label for=""><strong>Masukkan Password Lama</strong></label>
                                                    <input type="password" name="lpass" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label for=""><strong>Masukkan Password Baru</strong></label>
                                                    <input type="password" name="password" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label for=""><strong>Konfirmasi Password</strong></label>
                                                    <input type="password" name="password_confirmation" class="form-control">
                                                </div>
                                            </div>
                                            <div class="card-footer">
                                                <button type="submit" class="btn btn-primary btn-block">Ganti Password</button>
                                            </div>
                                            </form>
                                    <hr>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>    
@endsection