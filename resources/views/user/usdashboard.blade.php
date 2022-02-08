@extends('layout.layout')
@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>

    <!-- Content Row -->
    <div class="row">

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Langkah-langkah Melakukan Permintaan Legalisir</h6>
            </div>
            <div class="card-body">
                <div class="text-center">
                    <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" src="{{ URL::asset('silegon/img/czd.jpg') }}" alt="">
                </div>
                <span style="color: red;">Panduan penggunaan sistem</span>
                <p style="color: black;">
                    1. Jika anda pertama kali mengakses sistem ini, silahkan untuk mengisi profil anda pada tab profil.<br>
                    2. Kemudian untuk dapat menggunakan sistem ini, anda harus sudah mengisi Tracer Study yang telah
                    disediakan oleh FKIP UKSW, kemudian upload bukti pengisian Tracer Study tersebut pada bagian bawah menu
                    utama sistem ini. <br>
                    3. Setelah anda mengupload bukti pengisian Tracer Study dan bukti tersebut sudah divalidas oleh admin,
                    maka anda akan dapat mengakses menu daftar berkas dimana dalam menu ini anda akan dapat mengupload
                    berkas-berkas yang akan dilegalisir seperti Ijazah, Transkrip Nilai, dan Akta IV. <br>
                    4. Serta anda dapat mengakses menu pemesanan dimana dalam menu ini anda dapat memesan legalisir berkas
                    yang telah anda upload dan telah divalidasi admin, disini anda dapat memilih apakah berkas tersebut
                    dikirim atau diambil. <br>
                    5. Pada menu pemesanan, anda dapat melihat pemesanan anda, status pemesanan anda, mengupload bukti
                    pembayaran jika pemesanan dikirim, serta riwayat
                    pemesanan legalisir anda. <br>
                    6. Untuk panduan selengkapnya anda dapat mendownload panduan <strong><a
                            href="{{ URL::asset('/silegon/img/Panduan Sistem Legalisir Online.pdf') }}">Download</a></strong>
                </p>
                <p style="color: black;">Status Tracer Study :</p>
                @if ($TS->isEmpty() || $AT->status == 'Belum mengupload')
                    <button class="btn btn-secondary" disabled>Belum Mengupload</button>
                @elseif($AT->status == 'Ditolak')
                    <button class="btn btn-danger" disabled>{{ $AT->status }}</button>
                @elseif($AT->status == 'Valid')
                    <button class="btn btn-success" disabled>{{ $AT->status }}</button>
                @elseif($AT->status == 'Belum divalidasi')
                    <button class="btn btn-primary" disabled>{{ $AT->status }}</button>
                @endif
                <br><br>
                @if ($TS->isEmpty())
                    <button type="button" disabled="disabled" title="Silahkan Isi Profil Terlebih Dahulu"
                        class="btn btn-primary">Mengunggah Tracer Study</button>
                @else
                    <button type="button" data-toggle="modal" data-target="#exampleModalCenter"
                        class="btn btn-primary">Mengunggah Tracer Study</button>
            </div>
            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Upload Tracer Study</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="{{ route('inputtracerstudy') }}" enctype="multipart/form-data">
                                @csrf
                                @if (session('errors'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        Something it's wrong:
                                        <button type="button" class="close" data-dismiss="alert"
                                            aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <span>Upload Berkas :</span><br>
                                <div class="input-group mb-3">
                                    <div class="custom-file">
                                        <input type="file" id="vv" name="tracers">
                                    </div>
                                </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Upload</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
    </div>
@endsection
