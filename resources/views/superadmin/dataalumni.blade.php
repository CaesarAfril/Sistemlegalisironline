@extends('layout.layout')
@section('content')
    @php
    use App\Models\PRF;
    @endphp
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Sistem Legalisir Online SILEGON FKIP UKSW</h1>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="card-body">
                <h6 class="m-0 font-weight-bold text-primary">Data Alumni Sistem Legalisir Online FKIP UKSW</h6>
            </div>
            <p>Pada halaman ini anda dapat melihat daftar pengguna sistem ini.</p>
            <p>Total Pemesanan = {{ $total }}</p>
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Total Pemesanan</th>
                            <th>Terakhir Mengakses</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $a)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $a->name }}</td>
                                <td>{{ $a->email }}</td>
                                @php
                                    $cek = PRF::where('id_user', $a->id)->count();
                                    $tot = PRF::where('id_user', $a->id)->get();
                                @endphp
                                @if ($cek == null)
                                    <td>-</td>
                                @else
                                    @foreach ($tot as $tot)
                                        <td>{{ $tot->total_pemesanan }}</td>
                                    @endforeach
                                @endif
                                @if ($a->last_login_at == null)
                                    <td>-</td>
                                @else
                                    <td>{{ $a->last_login_at->isoFormat('D MMMM Y') }}</td>
                                @endif
                                <td><button type="button" data-toggle="modal"
                                        data-target="#exampleModalCenter-{{ $a->id }}" class="btn btn-danger"><i
                                            class="fas fa-trash"></i></button></td>
                                <div class="modal fade" id="exampleModalCenter-{{ $a->id }}" tabindex="-1"
                                    role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Hapus Akun</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="post" action="{{ route('hapusakun', ['id' => $a->id]) }}"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <span>Anda yakin menghapus user ini ?</span><br>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-primary">Hapus</button>
                                            </div>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
