@extends('layout.layout')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Sistem Legalisir Online SILEGON FKIP UKSW</h1>
</div>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="card-body">
        <h6 class="m-0 font-weight-bold text-primary">Data Program Studi Sistem Legalisir Online FKIP UKSW</h6>
        </div>
        <p>Pada halaman ini anda dapat melihat daftar program studi yang ada pada Fakultas Keguruan dan Ilmu Pendidikan Universitas Kristen Satya Wacana.</p>
        <button type="button" data-toggle="modal" data-target="#tambahprogdi" class="btn btn-primary">Tambah Program Studi Baru</button>
    </div>
    <div class="modal fade" id="tambahprogdi" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">tambah program studi baru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <form method="post" action="{{ route('dataprodi') }}" enctype="multipart/form-data">
                @csrf
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
                <span>Nama Program Studi :</span><br>
                <div class="input-group mb-3">
                    <input type="text" name="progdi" id="progdi" class="form-control">
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

    <div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Program Studi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $a)
                    <tr>
                        <td>{{ $loop->iteration}}</td>
                        <td>{{$a->nama}}</td>
                        <td><button type="button" data-toggle="modal" data-target="#hapus-{{$a->id}}" class="btn btn-danger"><i class="fas fa-trash"></i></button></td>
                        <div class="modal fade" id="hapus-{{$a->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">Hapus Progdi</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                <div class="modal-body">
                                    <span>Anda yakin menghapus program studi ini ?</span><br>
                                </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <a href="{{route('hapusprodi',['id' => $a->id])}}"><button class="btn btn-primary">Hapus</button></a>
                        </div>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
@endsection