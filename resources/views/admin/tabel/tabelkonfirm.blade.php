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
            @foreach ($MK as $MK)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    @php
                        $user = PRF::where('id_user', $MK->id_user)->get();
                        $berkas = DBS::where('id', $MK->id_berkas)->get();
                        $path = Storage::url('public/Bukti/' . $MK->bukti_pembayaran);
                    @endphp
                    @foreach ($user as $data)
                        <td>{{ $data->nama_lengkap }}</td>
                    @endforeach
                    @foreach ($berkas as $berkas)
                        <td>{{ $berkas->jenis_berkas }}</td>
                        <td>{{ $berkas->berkas }}</td>
                    @endforeach
                    @foreach ($user as $user)
                        <td><button type="button" data-toggle="modal" data-target="#tk-{{ $user->id }}"
                                class="btn btn-light">Detail</button></td>
                        <div class="modal fade" id="tk-{{ $user->id }}" tabindex="-1" role="dialog"
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
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <td>{{ $MK->pengiriman }}</td>
                    <td>{{ $MK->jumlah }}</td>
                    @if ($MK->pengiriman == 'Diambil')
                        <td>
                            <p>-</p>
                        </td>
                    @else
                        <td> <a href="{{ url($path) }}" download>
                                {{ $MK->bukti_pembayaran }}</a></td>
                    @endif
                    @if($MK->status == 'Menunggu Pembayaran')
                    <td>-</td>
                    @else
                    <td><a href="{{ route('konfirmasi', ['id' => $MK->id]) }}"><button type="button"
                                class="btn btn-primary">Validasi</button></a></td>
                    {{-- <td><button type="button" data-toggle="modal" data-target="#tk-{{$MK->id}}" class="btn btn-primary">Konfirmasi</button></td>
                                        <div class="modal fade" id="tk-{{$MK->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">Validasi Berkas</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                <div class="modal-body">
                                                    <form method="post" action="{{route('validberkas')}}" enctype="multipart/form-data">
                                                    @csrf
                                                    <span>Pilih Pemesanan</span><br>
                                                    <div class="input-group mb-3">
                                                    <input type="hidden" name="id" id="id" value="{{$berkas->id}}">
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
                        </div> --}}
                </tr>
                @endif
            @endforeach
        </tbody>
    </table>
    <p>*Jika pengguna memesan untuk dikirim</p>
</div>
