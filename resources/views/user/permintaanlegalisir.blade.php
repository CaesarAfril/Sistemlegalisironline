@extends('layout.layout')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-body">
            <h1 class="h3 mb-2 text-gray-800">Daftar Berkas Legalisir</h1>
            <p class="mb-4">Pada halaman ini anda dapat melakukan permintaan legalisir. Anda dapat memilih apakah
                berkas
                yang telah dilegalisir dikirim ke alamat anda atau diambil di gedung FKIP UKSW.</p>
        </div>
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Jenis Berkas</th>
                                <th>Nomor Berkas</th>
                                <th>File Berkas</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $data)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $data->jenis_berkas }}</td>
                                    <td>{{ $data->nomor_berkas }}</td>
                                    <td>{{ $data->berkas }}</td>
                                    @if ($data->status != 'diterima')
                                        <td><button type="button" class="btn btn-primary" disabled>Buat Permintaan</button>
                                        </td>
                                    @else
                                        <td><button type="button" data-toggle="modal"
                                                data-target="#exampleModalCenter-{{ $data->id }}"
                                                class="btn btn-primary">Buat Permintaan</button></td>
                                        <div class="modal fade" id="exampleModalCenter-{{ $data->id }}"
                                            tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">Pemesanan
                                                            Legalisir
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="post" action="{{ route('pesan') }}">
                                                            @csrf
                                                            <div class="form-group">
                                                                <span>Pilih Pemesanan</span><br>
                                                                <div class="input-group mb-3">
                                                                    <input type="hidden" name="id" id="id"
                                                                        value="{{ $data->id }}">

                                                                    <select name="jenis" id="jenis"
                                                                        class="custom-select form-control">
                                                                        <option selected hidden>Pilih Pemesanan</option>
                                                                        <option value="Diambil">Diambil</option>
                                                                        <option value="Dikirim">Dikirim</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <span>Jumlah Pemesanan</span>
                                                                <input type="number" name="jumlah" id="jumlah" min="0"
                                                                    class="form-control"
                                                                    placeholder="Masukkan Jumlah Pemesanan Legalisir">
                                                            </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-primary">Pesan</button>
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
