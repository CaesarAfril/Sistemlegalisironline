@extends('layout.layout')
@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Anda belum Mengupload Tracer Study</h1>
    </div>

    <!-- Content Row -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Langkah-langkah Mengisi Tracer Study</h6>
        </div>
        <div class="card-body">
            <span style="color: red;">Informasi Penting!</span>
            <p style="color: black;">
                Sebelum anda dapat melakukan pemesanan legalisir, pastikan bukti tracer study anda telah divalidasi dan
                diterima. Jika anda belum mengisi tracer study, silahkan mengisi tracer studi :<br>
                1. Untuk guru : <a href="https://fkip.uksw.edu/pages/kuesioner-alumni-guru">Disini</a><br>
                2. Untuk non-guru : <a href="https://fkip.uksw.edu/pages/kuesioner-alumni-non-guru">Disini</a> <br><br>
                <a href="{{ route('home') }}">
                    << Kembali Ke Dashboard</a>
            </p>
        </div>
    </div>
@endsection
