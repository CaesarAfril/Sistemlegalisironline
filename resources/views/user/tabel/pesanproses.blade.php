@php
use App\Models\DBS;
use App\Models\PNGR;
@endphp
<div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>No.</th>
                <th>Jenis Berkas</th>
                <th>File Berkas</th>
                <th>Pengiriman</th>
                <th>Detail</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $data)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    @php
                        $a = DBS::where('id', $data->id_berkas)->get();
                    @endphp
                    @foreach ($a as $item)
                        <td>{{ $item->jenis_berkas }}</td>
                        <td>{{ $item->berkas }}</td>
                    @endforeach
                    <td>{{ $data->pengiriman }}</td>
                    <td>
                        @if ($data->pengiriman == 'Diambil')
                            {{ $data->status }}
                        @elseif($data->pengiriman == 'Dikirim')
                            @php
                                $dats = PNGR::where('id_pemesan', $data->id)->get();
                            @endphp
                            @foreach ($dats as $pengirim)
                                <button type="button" data-toggle="modal" data-target="#www-{{ $pengirim->id }}"
                                    class="btn btn-light">Detail</button>
                                <div class="modal fade" id="www-{{ $pengirim->id }}" tabindex="-1" role="dialog"
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
                                                    $dataa = PNGR::find($pengirim->id);
                                                @endphp
                                                <p>Jumlah Pesanan : </p>
                                                <p>{{ $dataa->jumlah }}</p>
                                                <p>Alamat : </p>
                                                <p>{{ $dataa->alamat }}, {{ $dataa->kota }},
                                                    {{ $dataa->provinsi }}
                                                    {{ $dataa->kode_pos }}</p>
                                                <p>Ekspedisi : </p>
                                                <p> {{ $dataa->ekspedisi }} </p>
                                                <p>Harga : </p>
                                                <p>Rp {{ number_format($dataa->harga, 2, ',', '.') }}</p>
                                                <p>Status :</p>
                                                <p>{{ $data->status }}</p>
                                                <p>Resi :</p>
                                                <p>
                                                    @if ($dataa->resi == null)
                                                        -
                                                    @else
                                                        {{ $dataa->resi }}
                                                    @endif
                                                </p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-primary"
                                                    data-dismiss="modal">Ok</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </td>
                    <td>
                        @if ($data->status == 'Dikirim' || $data->status == 'Dapat Diambil')
                            @if ($data->pengiriman == 'Dikirim')
                                <button data-toggle="modal" data-target="#aa-{{ $data->id }}"
                                    class="btn btn-success"><i class="fas fa-fw fa-check"></i>Telah diterima</button>
                            @else
                                <button data-toggle="modal" data-target="#aa-{{ $data->id }}"
                                    class="btn btn-success"><i class="fas fa-fw fa-check"></i>Telah diambil</button>
                            @endif
                            <div class="modal fade" id="aa-{{ $data->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Penyelesaian Pembayaran
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Pastikan pesanan anda benar-benar telah sampai ke alamat pengiriman atau
                                                telah anda ambil di bagian TU FKIP UKSW.</p>
                                        </div>
                                        <div class="modal-footer">
                                            <form action="{{ route('selesai') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $data->id }}">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-primary">Selesai</button>
                                            </form>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @else
                            @if ($data->pengiriman == 'Dikirim')
                                @if ($data->status == 'Menunggu Pembayaran')
                                    <button data-toggle="modal" data-target="#bb-{{ $data->id }}"
                                        class="btn btn-primary"><i class="fas fa-fw fa-file"></i>Upload Bukti
                                        Pembayaran</button>
                                    <div class="modal fade" id="bb-{{ $data->id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLongTitle">Bukti Pembayaran
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="post" action="{{ route('buktibayar') }}"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        <input type="hidden" name="id" id="id"
                                                            value="{{ $data->id }}">
                                                        <label for="bb">Upload Bukti Pembayaran</label>
                                                        <input type="file" name="bb" id="bb">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary">Upload</button>
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <button data-toggle="modal" data-target="#hapusa-{{ $data->id }}"
                                        class="btn btn-danger"><i class="fas fa-fw fa-trash-alt"></i>Batalkan
                                        Pemesanan</button>
                                    <div class="modal fade" id="hapusa-{{ $data->id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLongTitle">Batalkan
                                                        Pemesanan</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="post"
                                                        action="{{ route('batalpemesanan', ['id' => $data->id]) }}"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        <span>Batalkan Pemesanan ?</span><br>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Tidak</button>
                                                    <button type="submit" class="btn btn-primary">Batal</button>
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <p>-</p>
                                @endif
                            @else
                                @if ($data->status == 'Menunggu Konfirmasi')
                                    <button data-toggle="modal" data-target="#hapusb-{{ $data->id }}"
                                        class="btn btn-danger"><i class="fas fa-fw fa-trash-alt"></i>Batalkan
                                        Pemesanan</button>
                                    <div class="modal fade" id="hapusb-{{ $data->id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLongTitle">Batalkan
                                                        Pemesanan</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="post"
                                                        action="{{ route('batalpemesanan', ['id' => $data->id]) }}"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        <span>Batalkan Pemesanan ?</span><br>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Tidak</button>
                                                    <button type="submit" class="btn btn-primary">Batal</button>
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <p>-</p>
                                @endif
                            @endif
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
