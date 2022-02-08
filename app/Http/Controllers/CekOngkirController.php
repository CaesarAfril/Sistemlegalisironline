<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use App\Models\PNGR;
use App\Models\Province;
use Kavist\RajaOngkir\Facades\RajaOngkir;

class CekOngkirController extends Controller
{

    public function index()
    {
        $provinces = Province::pluck('name', 'province_id');
        return view('ongkir', compact('provinces'));
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCities($id)
    {
        $city = City::where('province_id', $id)->pluck('name', 'city_id');
        return response()->json($city);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function check_ongkir(Request $request)
    {
        $cost = RajaOngkir::ongkosKirim([
            'origin'        => '386', // ID kota/kabupaten asal
            'destination'   => $request->city_destination, // ID kota/kabupaten tujuan
            'weight'        => $request->weight*7, // berat barang dalam gram
            'courier'       => 'pos' // kode kurir pengiriman: ['jne', 'tiki', 'pos'] untuk starter
        ])->get();


        return response()->json($cost);
    }
}
