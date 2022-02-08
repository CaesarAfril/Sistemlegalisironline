@extends('layout.layout')
@section('content')
    <!-- Content Row -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Silahkan Isi Data Diri Anda</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('profil') }}" method="post">
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
                    <div class="form-group">
                        <label for=""><strong>Nama Lengkap</strong></label>
                        <input type="text" name="name" class="form-control" placeholder="Nama Lengkap"
                            value="{{ Auth::user()->name }}">
                    </div>
                    <div class="form-group">
                        <label for=""><strong>NIM</strong></label>
                        <input type="text" name="NIM" class="form-control" placeholder="NIM">
                    </div>
                    <div class="form-group">
                        <label for=""><strong>Progdi</strong></label>
                        <select class="custom-select form-control" name="progdi">
                            <option hidden>Program Studi</option>
                            @foreach ($data as $data)
                                <option value="{{ $data->nama }}">{{ $data->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for=""><strong>Tahun Lulus</strong></label>
                        <input type="text" name="tahun" class="form-control" placeholder="Tahun Lulus">
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary btn-block">Selesai</button>
                </div>
            </form>
        </div>
    </div>
@endsection
