@extends('layout.layout')
@section('content')
    <!-- Content Row -->

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Diri</h6>
        </div>
        <div class="card-body">
            <p>Nama Lengkap : </p>
            <p>{{ $prof->nama_lengkap }}</p><br>
            <p>NIM : </p>
            <p>{{ $prof->NIM }}</p><br>
            <p>Program Studi : </p>
            <p> {{ $prof->program_studi }} </p><br>
            <p>Tahun Lulus : </p>
            <p>{{ $prof->tahun_lulus }}</p><br>

            <button type="button" data-toggle="modal" data-target="#exampleModalCenter-{{ $prof->id }}"
                class="btn btn-primary">Edit Profil</button>
            <div class="modal fade" id="exampleModalCenter-{{ $prof->id }}" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Edit Profil</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="{{ route('editprofil') }}">
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
                                    <input type="hidden" name="id" id="id" value="{{ $prof->id }}">
                                    <div class="form-group">
                                        <label for=""><strong>Nama Lengkap</strong></label>
                                        <input type="text" name="name" class="form-control"
                                            value="{{ $prof->nama_lengkap }}">
                                    </div>
                                    <div class="form-group">
                                        <label for=""><strong>NIM</strong></label>
                                        <input type="text" name="NIM" class="form-control" value="{{ $prof->NIM }}">
                                    </div>
                                    <div class="form-group">
                                        <label for=""><strong>Progdi</strong></label>
                                        <select class="custom-select form-control" name="progdi">
                                            <option value="{{ $prof->program_studi }}" selected hidden>
                                                {{ $prof->program_studi }}</option>
                                            @foreach ($data as $data)
                                                <option value="{{ $data->nama }}">{{ $data->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for=""><strong>Tahun Lulus</strong></label>
                                        <input type="text" name="tahun" class="form-control"
                                            value="{{ $prof->tahun_lulus }}">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <button type="button" data-toggle="modal" data-target="#gantipassword" class="btn btn-primary">Ganti
                Password</button>
            <div class="modal fade" id="gantipassword" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Ganti Password</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="{{ route('gantipassword') }}">
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
                                    <input type="hidden" name="id" id="id" value="{{ Auth::user()->id }}">
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
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary">Ganti</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    @endsection
