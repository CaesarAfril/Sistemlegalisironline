@extends('layout.loginlayout')
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
                                <div class="col-lg-6"><img src="{{ URL::asset('silegon/img/logofkip.png') }}"
                                        width="500 px"></div>
                                <div class="col-lg-6">
                                    <div class="p-5">
                                        <div class="text-center">
                                            <h1 class="h4 text-gray-900 mb-4">Sistem Legalisir Online</h1>
                                        </div>
                                        <form action="{{ route('login') }}" method="post">
                                            @csrf
                                            <div class="card-body">
                                                @if (session('errors'))
                                                    <div class="alert alert-danger alert-dismissible fade show"
                                                        role="alert">
                                                        Something it's wrong:
                                                        <button type="button" class="close" data-dismiss="alert"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                        <ul>
                                                            @foreach ($errors->all() as $error)
                                                                <li>{{ $error }}</li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                @endif
                                                @if (Session::has('success'))
                                                    <div class="alert alert-success">
                                                        {{ Session::get('success') }}
                                                    </div>
                                                @endif
                                                @if (Session::has('error'))
                                                    <div class="alert alert-danger">
                                                        {{ Session::get('error') }}
                                                    </div>
                                                @endif
                                                <div class="form-group">
                                                    <label for=""><strong>Email</strong></label>
                                                    <input type="text" name="email" class="form-control"
                                                        placeholder="Email">
                                                </div>
                                                <div class="form-group">
                                                    <label for=""><strong>Password</strong></label>
                                                    <input type="password" name="password" class="form-control"
                                                        placeholder="Password">
                                                </div>
                                            </div>
                                            <div class="card-footer">
                                                <button type="submit" class="btn btn-primary btn-block">Log In</button>
                                                <p class="text-center">Belum punya akun? <a
                                                        href="{{ route('register') }}">Register</a> sekarang!</p>
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
