<div class="table-responsive">
    <table class="table table-bordered" id="datatracer" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama</th>
                <th>NIM</th>
                <th>Program Studi</th>
                <th>Tahun Lulus</th>
                <th>Bukti Tracer Study</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($trace as $trace)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $trace->nama_lengkap }}</td>
                    <td>{{ $trace->program_studi }}</td>
                    <td>{{ $trace->NIM }}</td>
                    <td>{{ $trace->tahun_lulus }}</td>
                    @php
                        $path = Storage::url('public/tracer/' . $trace->tracer_study);
                    @endphp
                    <td><a href="{{ url($path) }}" download>{{ $trace->tracer_study }}</a></td>
                    <td><button type="button" data-toggle="modal" data-target="#tc-{{ $trace->id }}"
                            class="btn btn-primary">Validasi</button></td>
                    <div class="modal fade" id="tc-{{ $trace->id }}" tabindex="-1" role="dialog"
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
                                    <form method="post" action="{{ route('validtracer') }}"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <span>Pilih Pemesanan</span><br>
                                        <div class="input-group mb-3">
                                            <input type="hidden" name="id" id="id" value="{{ $trace->id }}">
                                            <select name="jenis" id="jenis" class="custom-select form-control">
                                                <option selected hidden>Pilih Validasi</option>
                                                <option value="Valid">Diterima</option>
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
