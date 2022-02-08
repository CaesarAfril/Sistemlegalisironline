@extends('layout.maillayout')
@section('content')
    @if ($data['status'] == 'Menunggu Konfirmasi')
        <p>Pemesanan legalisir anda dengan jenis file {{ $data['jenis'] }} dengan file {{ $data['file'] }} yang akan
            {{ $data['pengiriman'] }} telah diterima oleh sistem, silahkan menunggu admin untuk konfirmasi pesanan anda.
        </p>
    @elseif($data['status'] == 'Sedang Diproses')
        <p>Pemesanan legalisir anda dengan jenis file {{ $data['jenis'] }} dengan file {{ $data['file'] }} yang akan
            {{ $data['pengiriman'] }} sedang diproses oleh admin.</p>
    @elseif($data['status'] == 'Dapat Diambil')
        <p>Pemesanan legalisir anda dengan jenis file {{ $data['jenis'] }} dengan file {{ $data['file'] }} yang akan
            {{ $data['pengiriman'] }} telah diproses dan selesai oleh admin, silahkan ambil berkas legalisir anda di TU
            FKIP
            UKSW pada jam kerja.</p>
    @elseif($data['status'] == 'Selesai')
        <p>Pemesanan legalisir anda dengan jenis file {{ $data['jenis'] }} dengan file {{ $data['file'] }} yang akan
            {{ $data['pengiriman'] }} telah selesai dan telah anda ambil di ruang TU FKIP UKSW, terima kasih telah
            menggunakan SILEGON.</p>
    @endif
@endsection
