@extends('layout.layout')
@section('sidebar')
    <li class="nav-item ">
        <a class="nav-link" href="{{ route('home') }}">
            <i class="fas fa-fw fa-home"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('daftarberkas') }}">
            <i class="fas fa-fw fa-folder"></i>
            <span>Daftar Berkas</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('permintaanlegalisir') }}">
            <i class="fas fa-fw fa-file-alt"></i>
            <span>Permintaan Legalisir</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('profil') }}">
            <i class="fas fa-fw fa-user"></i>
            <span>Profil</span></a>
    </li>


    <li class="nav-item">
        <a class="nav-link" href="{{ route('pemesanan') }}">
            <i class="fas fa-fw fa-envelope"></i>
            <span>Pemesanan</span></a>
    </li>
@endsection
@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Sistem Legalisir Online SILEGON FKIP UKSW</h1>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="card-body">
                <h6 class="m-0 font-weight-bold text-primary">Silahkan pilih jenis paket ekspedisi</h6>
                <div class="table-responsive">
                    <table class="table table-bordered" id="ekspedisi" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Jenis</th>
                                <th>Harga</th>
                                <th>Estimasi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cost as $decoded)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $decoded->service }}</td>
                                    <td>{{ $decoded->cost[0] . value }}</td>
                                    <td>{{ $decoded->cost[0] . etd }}</td>
                                    <td></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
