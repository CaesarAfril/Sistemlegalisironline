@extends('layout.layout')
@php
use App\Models\DBS;
@endphp
@section('content')
    <div class="card shadow mb-4">
        <div class="card-body">
            <h1 class="h3 mb-2 text-gray-800">Daftar Berkas Legalisir</h1>
            <p class="mb-4">Pada halaman ini anda dapat mengunggah berkas-berkas yang dapat dilegalisir meliputi
                Ijazah,
                Akta IV, serta Transkrip Nilai. Selain itu, anda dapat melihat status validasi dari berkas tersebut pada
                halaman ini.</p>
            <button type="button" data-toggle="modal" data-target="#exampleModalCenter" class="btn btn-primary">Mengunggah
                Berkas</button>
        </div>
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Upload Berkas</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="{{ route('daftarberkas') }}" enctype="multipart/form-data">
                            @csrf
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
                            <span>Jenis Berkas :</span><br>
                            <div class="input-group mb-3">
                                <select name="jenis" id="jenis" class="custom-select form-control">
                                    <option selected hidden>Pilih Jenis Dokumen</option>
                                    <option value="Ijazah S1">Ijazah S1</option>
                                    <option value="Ijazah S2">Ijazah S2</option>
                                    <option value="Ijazah S3">Ijazah S3</option>
                                    <option value="Akta IV">Akta IV</option>
                                    <option value="Transkrip Nilai">Transkrip Nilai</option>
                                </select>
                            </div>
                            <span>Nomor Berkas* :</span><br>
                            <div class="input-group mb-3">
                                <input type="text" name="nomorberkas" id="nomorberkas" class="form-control">
                            </div>
                            <span>Scan Berkas (.pdf) :</span><br>
                            <div class="input-group mb-3">
                                <div class="custom-file">
                                    <input type="file" id="berka" name="berkas">
                                </div>
                            </div>
                            <span>Upload Validator (KTM/KTM Lulus) :</span><br>
                            <div class="input-group mb-3">
                                <div class="custom-file">
                                    <input type="file" id="vv" name="validator">
                                </div>
                            </div>
                    </div>

                    <div class="modal-footer">
                        <span>*Jika jenis berkas merupakan Transkrip nilai, silahkan isi dengan tanda -</span>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                    </form>
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
                                <th>Jenis Berkas</th>
                                <th>Nomor Berkas</th>
                                <th>File Berkas</th>
                                <th>Scan Validator</th>
                                <th>Validasi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $data)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $data->jenis_berkas }}</td>
                                    <td>{{ $data->nomor_berkas }}</td>
                                    <td>
                                        @php
                                            if ($data->jenis_berkas == 'Transkrip Nilai') {
                                                $path = Storage::url('public/Transkrip/' . $data->berkas);
                                            } elseif ($data->jenis_berkas == 'Akta IV') {
                                                $path = Storage::url('public/Akta IV/' . $data->berkas);
                                            } else {
                                                $path = Storage::url('public/Ijazah/' . $data->berkas);
                                            }
                                        @endphp
                                        <a href="{{ url($path) }}" download>
                                            {{ $data->berkas }}</a>
                                    </td>
                                    <td>
                                        @php
                                            $path = Storage::url('public/validator/' . $data->validator);
                                        @endphp
                                        <a href="{{ url($path) }}" download>
                                            {{ $data->validator }}</a>
                                    </td>
                                    <td>
                                        @php
                                            if ($data->status == 'belum') {
                                                echo "<i class='fas fa-minus-circle'>Belum Divalidasi</i>";
                                            } elseif ($data->status == 'diterima') {
                                                echo "<i class='fas fa-check-circle text-success'>Diterima</i>";
                                            } else {
                                                echo "<i class='fas fa-times-circle text-danger'>Ditolak</i>";
                                            }
                                        @endphp
                                    </td>
                                    <td>
                                        <button data-toggle="modal" data-target="#edit-{{ $data->id }}"
                                            class="btn btn-warning btn-icon-split btn-sm" style="padding: 5px 10px 5px;"
                                            onclick="selectvalue()"><i class="fas fa-edit"></i></button>
                                        <div class="modal fade" id="edit-{{ $data->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">Edit Berkas
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="post" action="{{ route('editberkas') }}"
                                                            enctype="multipart/form-data">
                                                            @csrf
                                                            @if (session('errors'))
                                                                <div class="alert alert-danger alert-dismissible fade show"
                                                                    role="alert">
                                                                    Something it's wrong:
                                                                    <button type="button" class="close"
                                                                        data-dismiss="alert" aria-label="Close">
                                                                        <span aria-hidden="true">×</span>
                                                                    </button>
                                                                    <ul>
                                                                        @foreach ($errors->all() as $error)
                                                                            <li>{{ $error }}</li>
                                                                        @endforeach
                                                                    </ul>
                                                                </div>
                                                            @endif
                                                            <input type="hidden" name="id" id="id"
                                                                value="{{ $data->id }}">
                                                            <span>Nomor Berkas :</span><br>
                                                            <div class="input-group mb-3">
                                                                <input type="text" name="enomorberkas" id="enomorberkas"
                                                                    class="form-control">
                                                            </div>
                                                            <span>Scan Berkas (.pdf) :</span><br>
                                                            <div class="input-group mb-3">
                                                                <div class="custom-file">
                                                                    <input type="file" id="berkas" name="berkas">
                                                                </div>
                                                            </div>
                                                            <span>Upload Validator (KTM/KTM Lulus) :</span><br>
                                                            <div class="input-group mb-3">
                                                                <div class="custom-file">
                                                                    <input type="file" id="valid" name="validator">
                                                                </div>
                                                            </div>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <button data-toggle="modal" data-target="#hapus-{{ $data->id }}"
                                            class="btn btn-danger btn-icon-split btn-sm" style="padding: 5px 10px 5px;"><i
                                                class="fas fa-trash"></i></button>
                                        <div class="modal fade" id="hapus-{{ $data->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">Hapus Berkas
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="post"
                                                            action="{{ route('hapusberkas', ['id' => $data->id]) }}"
                                                            enctype="multipart/form-data">
                                                            @csrf
                                                            <span>Anda yakin menghapus berkas ini ?</span><br>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-primary">Hapus</button>
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
