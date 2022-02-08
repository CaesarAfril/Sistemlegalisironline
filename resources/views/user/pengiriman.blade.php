@extends('layout.layout')
@section('head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @php
    use App\Models\PMSN;
    @endphp
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-8">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Formulir Pengiriman</h6>
                </div>
                <div class="card-body">
                    <form class="user" method="post" action="{{ route('kirim') }}">
                        @csrf
                        <div class="card-body">
                            @if (session('errors'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    Something it's wrong:
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <input type="hidden" name="id" value="{{ $data }}">
                            <div class="form-group row">
                                @php
                                    $jml = PMSN::find($data);
                                @endphp
                                <div class="col-lg-12">
                                    <input type="hidden" class="form-control" name="weight" id="weight"
                                        placeholder="Masukkan Jumlah Berkas" value="{{ $jml->jumlah }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for=""><strong>Provinsi</strong></label>
                                <select class="custom-select form-control" name="province_destination">
                                    <option value="0">-- pilih provinsi tujuan --</option>
                                    @foreach ($provinces as $province => $value)
                                        <option value="{{ $province }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for=""><strong>Kota</strong></label>
                                <select class="custom-select form-control" name="city_destination">
                                    <option value="">-- pilih kota tujuan --</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <button class="btn btn-md btn-primary btn-block btn-check">Pilih Menu Ekspedisi</button>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <div class="card d-none ongkir">
                                    <div class="card-body">
                                        <p><b>*Belum Termasuk Biaya Admin Sebesar Rp.1.500,00,-</b></p>
                                        <ul class="list-group" id="ongkir"></ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('javascript')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            //active select2
            $(".provinsi-asal , .kota-asal, .provinsi-tujuan, .kota-tujuan").select2({
                theme: 'bootstrap4',
                width: 'style',
            });
            //ajax select kota tujuan
            $('select[name="province_destination"]').on('change', function() {
                let provindeId = $(this).val();
                if (provindeId) {
                    jQuery.ajax({
                        url: '/cities/' + provindeId,
                        type: "GET",
                        dataType: "json",
                        success: function(response) {
                            $('select[name="city_destination"]').empty();
                            $('select[name="city_destination"]').append(
                                '<option value="">-- pilih kota tujuan --</option>');
                            $.each(response, function(key, value) {
                                $('select[name="city_destination"]').append(
                                    '<option value="' + key + '">' + value +
                                    '</option>');
                            });
                        },
                    });
                } else {
                    $('select[name="city_destination"]').append(
                        '<option value="">-- pilih kota tujuan --</option>');
                }
            });
            //ajax check ongkir
            let isProcessing = false;
            $('.btn-check').click(function(e) {
                e.preventDefault();

                let token = $("meta[name='csrf-token']").attr("content");
                let city_destination = $('select[name=city_destination]').val();
                let weight = $('#weight').val();

                if (isProcessing) {
                    return;
                }

                isProcessing = true;
                jQuery.ajax({
                    url: "/ongkir",
                    data: {
                        _token: token,
                        city_destination: city_destination,
                        weight: weight,
                    },
                    dataType: "JSON",
                    type: "POST",
                    success: function(response) {
                        isProcessing = false;
                        if (response) {
                            $('#ongkir').empty();
                            $('.ongkir').addClass('d-block');
                            $.each(response[0]['costs'], function(key, value) {
                                $('#ongkir').append('<li class="list-group-item">' +
                                    response[0].code.toUpperCase() + ' : <strong>' +
                                    value.service + '</strong> - Rp. ' + value.cost[
                                        0].value + ' (' + value.cost[0].etd +
                                    ')<input type="hidden" name="service" id="service" value="' +
                                    value.service +
                                    '"><input type="hidden" name="harga" id="harga" value="' +
                                    value.cost[0].value +
                                    '"><button type="submit" class="btn btn-md btn-primary btn-block btn-check">pilih</button></form></li>'
                                )
                            });

                        }
                    }
                });

            });

        });
    </script>
@endsection
