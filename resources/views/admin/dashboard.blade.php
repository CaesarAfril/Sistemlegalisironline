@extends('layout.layout')
@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Sistem Legalisir Online SILEGON FKIP UKSW</h1>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="card-body">
                <h6 class="m-0 font-weight-bold text-primary">Selamat Datang di Sistem legalisir online</h6>
            </div>
            <p>Pada sistem ini anda dapat melakukan validasi terhadap berkas serta tracer study dari pengguna serta dapat
                melakukan transaksi pemesanan legalisir berkas pengguna.</p>
            <p>Panduan :</p>
            <div class="card card-primary card-outline card-outline-tabs">
                <div class="card-header p-0 border-bottom-0">
                    <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill"
                                href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home"
                                aria-selected="true">Validasi Berkas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill"
                                href="#custom-tabs-four-profile" role="tab" aria-controls="custom-tabs-four-profile"
                                aria-selected="false">Transaksi Pemesanan</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="custom-tabs-four-tabContent">
                        <div class="tab-pane fade show active" id="custom-tabs-four-home" role="tabpanel"
                            aria-labelledby="custom-tabs-four-home-tab">
                            <p>Untuk melakukan validasi transaksi :</p>
                            <p>1. Pilih menu tab validasi.</p>
                            <p>2. Kemudian pilih tab validasi berkas untuk melakukan validasi berkas pengguna dan tab
                                validasi tracer study untuk melakukan validasi bukti tracer study pengguna.</p>
                            <p>3. Anda dapat mendownload berkas maupun validator berkas dengan cara klik pada nama berkas
                                pada kolom file berkas dan validator.</p>
                            <p>4. Untuk melakukan validasi, klik tombol validasi, akan muncul pop-up untuk memilih apakah
                                berkas tersebut diterima atau tidak, jika telah diisi kemudian klik selesai.</p>
                        </div>
                        <div class="tab-pane fade" id="custom-tabs-four-profile" role="tabpanel"
                            aria-labelledby="custom-tabs-four-profile-tab">
                            <p>Untuk transaksi pemesanan :</p>
                            <p>1. Pilih menu tab pemesanan legalisir.</p>
                            <p>2. Untuk konfirmasi pemesanan, silahkan pilih tab Konfirmasi Admin dan klik validasi dan
                                berkas tersebut dianggap sedang diproses oleh admin.</p>
                            <p>3. Jika proses administrasi telah selesai, pilih tab Sedang Diproses, kemudian klik validasi
                                dan jika berkas dikirim, statusnya akan berganti dikirim, jika berkas diambil, statusnya
                                akan berganti menjadi dapat diambil</p>
                            <p>4. Untuk menyelesaikan pemesanan dan oleh pengguna belum diselesaikan walaupun telah diterima
                                atau diambil, pilih tab penyelesaian, kemudian klik selesai.</p>
                        </div>
                    </div>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
@endsection
