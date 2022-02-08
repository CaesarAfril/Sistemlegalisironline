@extends('layout.layout')
@section('sidebar')
@endsection
@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Sistem Legalisir Online SILEGON FKIP UKSW</h1>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="card-body">
                <h6 class="m-0 font-weight-bold text-primary">Validasi Berkas Sistem Legalisir Online FKIP UKSW</h6>
            </div>
            <p>Pada halaman ini anda dapat melihat memvalidasi berkas yang telah diupload oleh pengguna.</p>
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
                                        aria-selected="true">Validasi Berkas</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill"
                                        href="#custom-tabs-four-profile" role="tab" aria-controls="custom-tabs-four-profile"
                                        aria-selected="false">Validasi Tracer Study</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content" id="custom-tabs-four-tabContent">
                                <div class="tab-pane fade show active" id="custom-tabs-four-home" role="tabpanel"
                                    aria-labelledby="custom-tabs-four-home-tab">
                                    @include('admin.tabel.tabelberkas')
                                </div>
                                <div class="tab-pane fade" id="custom-tabs-four-profile" role="tabpanel"
                                    aria-labelledby="custom-tabs-four-profile-tab">
                                    @include('admin.tabel.tabeltracer')
                                </div>
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('javascript')
    <script>
        $(document).ready(function() {
            $('#databerkas').DataTable({
                "order": [
                    [0, "asc"]
                ]
            });
            $('#datatracer').DataTable({
                "order": [
                    [0, "asc"]
                ]
            });
        });
    </script>
@endsection
