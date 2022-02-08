@extends('layout.maillayout')
@section('content')
    @if ('vv' == 'berkas')
        <p>Berkas {{$data['jenis']}} dengan file bernama {{$data['berkas']}} 
        @if ($data['status'] == 'diterima')
            telah divalidasi dan diterima.
        @else
            dianggap belum memenuhi persyaratan dan ditolak. Silahkan upload ulang berkas melalui bagian Edit Berkas.
        @endif 
    @else
        <p>Bukti pengisian tracer study anda 
            @if ($data['status'] == 'diterima')
                telah divalidasi dan diterima.
            @else
                dianggap belum memenuhi persyaratan dan ditolak. Silahkan upload ulang bukti pengisian tracer study pada bagian dashboard sistem.
            @endif
    @endif
@endsection