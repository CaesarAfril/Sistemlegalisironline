@extends('layout.layout')
@php
use App\Models\DBS;
@endphp
@section('content')
    <div class="card shadow mb-4">
        <div class="card-body">
            <h1 class="h3 mb-2 text-gray-800">Pemesanan Legalisir</h1>
            <p class="mb-4">Pada halaman ini anda dapat melihat pemesanan legalisir anda.</p>
        </div>
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="col-12 col-sm-12">
                    <div class="card card-primary card-outline card-outline-tabs">
                        <div class="card-header p-0 border-bottom-0">
                            <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill"
                                        href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home"
                                        aria-selected="true">Pemesanan</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill"
                                        href="#custom-tabs-four-profile" role="tab" aria-controls="custom-tabs-four-profile"
                                        aria-selected="false">History Pemesanan</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content" id="custom-tabs-four-tabContent">
                                <div class="tab-pane fade show active" id="custom-tabs-four-home" role="tabpanel"
                                    aria-labelledby="custom-tabs-four-home-tab">
                                    @include('user.tabel.pesanproses')
                                </div>
                                <div class="tab-pane fade" id="custom-tabs-four-profile" role="tabpanel"
                                    aria-labelledby="custom-tabs-four-profile-tab">
                                    @include('user.tabel.history')
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
