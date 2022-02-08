@php
use App\Models\DBS;
use App\Models\PRF;
use App\Models\PNGR;
@endphp
<div class="table-responsive">
    <table class="table table-bordered" id="datawww" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama Pemesan</th>
                <th>Jenis Berkas</th>
                <th>Berkas</th>
                <th>Detail Pemesan</th>
                <th>Pengiriman</th>
                <th>Jumlah</th>
                <th>Resi Pembayaran*</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($DK as $DK)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    @php
                        $user = PRF::where('id_user', $DK->id_user)->get();
                        $berkas = DBS::where('id', $DK->id_berkas)->get();
                        $res = PNGR::where('id_pemesan', $DK->id)->get();
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
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-label="close">
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
                    <td>{{ $DK->jumlah }}</td>
                    <td>{{ $DK->pengiriman }}</td>
                    @if ($DK->pengiriman == 'Diambil')
                        <td>
                            <p>-</p>
                        </td>
                    @else
                        @foreach ($res as $ss)
                            <td>{{ $ss->resi }}</td>
                        @endforeach
                    @endif
                    <td><button data-toggle="modal" data-target="#aa-{{ $DK->id }}" class="btn btn-success"><i
                                class="fas fa-fw fa-check"></i>Selesai</button></td>
                    <div class="modal fade" id="aa-{{ $DK->id }}" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Penyelesaian Pemesanan</h5>
                                    <button type="button" class="close" data-dismiss="modal"
                                        aria-label="close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>Anda yakin untuk menyelesaikan pemesanan ini ?</p>
                                </div>
                                <div class="modal-footer">
                                    <form action="{{ route('selesaiadm') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $DK->id }}">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary">Selesai</button>
                                    </form>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </tr>
            @endforeach
        </tbody>
    </table>
    <p>*Jika pengguna memesan untuk dikirim</p>
</div>
