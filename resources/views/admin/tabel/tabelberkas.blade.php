@php
use App\Models\PRF;
@endphp
<div class="table-responsive">
    <table class="table table-bordered" id="databerkas" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama</th>
                <th>NIM</th>
                <th>Program Studi</th>
                <th>Tahun Lulus</th>
                <th>Jenis Berkas</th>
                <th>Nomor Berkas</th>
                <th>File Berkas</th>
                <th>Validator</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($berkas as $berkas)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    @php
                        $data = PRF::where('id_user', $berkas->id_user)->get();
                    @endphp
                    @foreach ($data as $data)
                        <td>{{ $data->nama_lengkap }}</td>
                        <td>{{ $data->NIM }}</td>
                        <td>{{ $data->program_studi }}</td>
                        <td>{{ $data->tahun_lulus }}</td>
                    @endforeach
                    @php
                        if ($data->jenis_berkas == 'Transkrip Nilai') {
                            $path = Storage::url('public/Transkrip/' . $data->berkas);
                        } elseif ($data->jenis_berkas == 'Akta IV') {
                            $path = Storage::url('public/Akta IV/' . $data->berkas);
                        } else {
                            $path = Storage::url('public/Ijazah/' . $data->berkas);
                        }
                    @endphp
                    <td>{{ $berkas->jenis_berkas }}</td>
                    <td>{{ $berkas->nomor_berkas }}</td>
                    <td> <a href="{{ url($path) }}" download>
                            {{ $berkas->berkas }}</a></td>
                    <td>@php
                        $paths = Storage::url('public/validator/' . $data->validator);
                    @endphp
                        <a href="{{ url($paths) }}" download>
                            {{ $berkas->validator }}</a>
                    </td>
                    <td><button type="button" data-toggle="modal" data-target="#exampleModalCenter-{{ $berkas->id }}"
                            class="btn btn-primary">Validasi</button></td>
                    <div class="modal fade" id="exampleModalCenter-{{ $berkas->id }}" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Validasi Berkas</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form method="post" action="{{ route('validberkas') }}"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <span>Pilih Pemesanan</span><br>
                                        <div class="input-group mb-3">
                                            <input type="hidden" name="id" id="id" value="{{ $berkas->id }}">
                                            <select name="jenis" id="jenis" class="custom-select form-control">
                                                <option selected hidden>Pilih Validasi</option>
                                                <option value="diterima">Diterima</option>
                                                <option value="ditolak">Ditolak</option>
                                            </select>
                                        </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary">Selesai</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
