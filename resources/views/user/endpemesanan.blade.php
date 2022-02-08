@extends('layout.layout')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-8">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Alamat</h6>
                </div>
                <div class="card-body">
                    <form class="user" method="post" action="{{ route('expi') }}">
                        @csrf
                        <div class="card-body">
                            @if (session('errors'))
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
                            <input type="hidden" name="id" value="{{ $id }}">
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <input type="textarea" class="form-control" name="alamat"
                                        placeholder="Masukkan Alamat Lengkap">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-12">
                                    <input type="text" class="form-control" name="kodepos" placeholder="Masukkan Kode Pos">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-6">
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    Pesan
                                </button>
                    </form>
                </div>
                <div class="col-lg-6">
                    <button data-toggle="modal" data-target="#hapus-{{ $id }}"
                        class="btn btn-danger btn-user btn-block">Batal</button>
                    <div class="modal fade" id="hapus-{{ $id }}" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Batal Pemesanan</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form method="post" action="{{ route('hapuspemesanan', ['id' => $id]) }}"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <span>Anda yakin membatalkan pemesanan ini ?</span><br>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                                    <button type="submit" class="btn btn-primary">Batal</button>
                                </div>
                            </div>
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
