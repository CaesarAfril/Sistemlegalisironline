@php
use App\Models\DBS;
use App\Models\PRF;
@endphp
<div class="table-responsive">
    <table class="table table-bordered" id="databerkas" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama Pemesan</th>
                <th>Jenis Berkas</th>
                <th>Berkas</th>
                <th>Detail Pemesan</th>
                <th>Pengiriman</th>
                <th>Jumlah</th>
                <th>Bukti Bayar*</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($SD as $SD)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    @php
                        $user = PRF::where('id_user', $SD->id_user)->get();
                        $berkas = DBS::where('id', $SD->id_berkas)->get();
                        $path = Storage::url('public/Bukti/' . $SD->bukti_pembayaran);
                    @endphp
                    @foreach ($user as $data)
                        <td>{{ $data->nama_lengkap }}</td>
                    @endforeach
                    @foreach ($berkas as $berkas)
                        <td>{{ $berkas->jenis_berkas }}</td>
                        <td>{{ $berkas->berkas }}</td>
                    @endforeach
                    @foreach ($user as $user)
                        <td><button type="button" data-toggle="modal" data-target="#ss-{{ $user->id }}"
                                class="btn btn-light">Detail</button></td>
                        <div class="modal fade" id="ss-{{ $user->id }}" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">Detail Pemesan</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        @php
                                            $dataa = PRF::find($user->id);
                                        @endphp
                                        <p>Nama Lengkap : </p>
                                        <p>{{ $dataa->nama_lengkap }}</p><br>
                                        <p>NIM : </p>
                                        <p>{{ $dataa->NIM }}</p><br>
                                        <p>Program Studi : </p>
                                        <p> {{ $dataa->program_studi }} </p><br>
                                        <p>Tahun Lulus : </p>
                                        <p>{{ $dataa->tahun_lulus }}</p><br>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" data-dismiss="modal">Ok</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <td>{{ $SD->jumlah }}</td>
                    <td>{{ $SD->pengiriman }}</td>
                    @if ($SD->pengiriman == 'Diambil')
                        <td>
                            <p>-</p>
                        </td>
                    @else
                        <td> <a href="{{ url($path) }}" download>
                                {{ $SD->bukti_pembayaran }}</a></td>
                    @endif
                    @if ($SD->pengiriman == 'Diambil')
                        <td><a href="{{ route('prosesambil', ['id' => $SD->id]) }}"><button type="button"
                                    class="btn btn-primary">Validasi</button></a></td>
                    @else
                        <td><button type="button" data-toggle="modal" data-target="#aca-{{ $SD->id }}"
                                class="btn btn-primary">Validasi</button></td>
                        <div class="modal fade" id="aca-{{ $SD->id }}" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">Resi Pengiriman</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post" action="{{ route('proseskirim') }}"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <span>Masukkan Resi</span><br>
                                            <div class="input-group mb-3">
                                                <input type="hidden" name="id" id="id" value="{{ $SD->id }}">
                                                <input type="text" name="resi" id="resi" class="form-control">
                                            </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary">Selesai</button>
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
    <p>*Jika pengguna memesan untuk dikirim</p>
</div>
