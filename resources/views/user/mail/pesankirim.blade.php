@extends('layout.maillayout')
@section('content')
    @if ($data['status'] == 'Menunggu Konfirmasi')
        <p>Bukti pembayaran legalisir {{ $data['jenis'] }} dengan nama file {{ $data['file'] }} telah diterima oleh
            sistem,
            silahkan menunggu admin untuk konfirmasi pesanan anda.</p>
    @elseif($data['status'] == 'bayar')
        <p>Pemesanan legalisir dengan data sebagai berikut :</p>
        <p>Jenis file&nbsp; &nbsp; &nbsp;= {{ $data['jenis'] }}</p>
        <p>Nama file&nbsp; &nbsp; = {{ $data['file'] }}</p>
        <p>Jumlah&nbsp; &nbsp; &nbsp; &nbsp; = {{ $data['jumlah'] }}</p>
        <p>Alamat&nbsp; &nbsp; &nbsp; &nbsp; = {{ $data['alamat'] }}</p>
        <p>Kota&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; = {{ $data['kota'] }}</p>
        <p>Provinsi&nbsp; &nbsp; &nbsp; &nbsp;= {{ $data['provinsi'] }}</p>
        <p>Kode Pos&nbsp; &nbsp; = {{ $data['kode'] }}</p>
        <p>Ekspedisi&nbsp; &nbsp; = {{ $data['eks'] }}</p>
        <p>Harga&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; = Rp {{ number_format($data['harga'], 2, ',', '.') }}</p>
        <p>Untuk melanjutkan pemesanan silahkan melakukan pembayaran sesuai dengan harga yang tertera melalui transfer
            4134134131 A/n FKIP UKSW.</p>
    @elseif($data['status'] == 'Sedang Diproses')
        <p>Pemesanan legalisir anda dengan jenis file {{ $data['jenis'] }} dengan file {{ $data['file'] }} yang akan
            {{ $data['pengiriman'] }} sedang diproses oleh admin.</p>
    @elseif($data['status'] == 'Dikirim')
        <p>Pemesanan legalisir anda dengan jenis file {{ $data['jenis'] }} dengan file {{ $data['file'] }} yang akan
            {{ $data['pengiriman'] }} telah dikirim sesuai dengan pilihan ekspedisi anda. Berikut nomor resi anda :</p>
        <p strong>{{ $data['resi'] }}</p>
    @elseif($data['status'] == 'Selesai')
        <p>Pemesanan legalisir anda dengan jenis file {{ $data['jenis'] }} dengan file {{ $data['file'] }} yang akan
            {{ $data['pengiriman'] }} telah anda terima, terima kasih atas menggunakan SILEGON</p>
    @endif
@endsection
