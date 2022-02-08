<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use Hash;
use Session;
use App\Models\User;
use App\Models\PRF;
use App\Models\DBS;
use App\Models\DPS;
use App\Models\PMSN;
use App\Models\PNGR;
use Storage;
use Mail;
use App\Mail\SendGmail;
use App\Mail\psnda;
use App\Mail\psn;

class AdmController extends Controller
{
    public function showvalidberkas() {
        $berkas = DBS::where('status','belum')->get();
        $trace = PRF::where('status','Belum divalidasi')->get();
        return view('admin.validasi', compact('berkas','trace'));
    }

    public function validberkas(Request $request){
        $rules = [
            'jenis' => 'required'
        ];

        $messages = [
            'jenis.required' => 'Silahkan pilih jenis validasi!'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
  
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }

        if($request->jenis == 'diterima') {
            $valid = DBS::find($request->id);
            $valid->status = 'diterima';
            $valid->update();

            $data = array(
                'jenis' => $valid->jenis_berkas,
                'nomor' => $valid->nomor_berkas,
                'berkas' => $valid->berkas,
                'status' => 'diterima',
                'vv' => 'berkas'
            );
            
            $user = User::find($valid->id_user);
            Mail::to($user->email)->send(new SendGmail($data));
            return back();
        } else{
            $valid = DBS::find($request->id);
            $valid->status = 'ditolak';
            $valid->update();

            $data = array(
                'jenis' => $valid->jenis_berkas,
                'nomor' => $valid->nomor_berkas,
                'berkas' => $valid->berkas,
                'status' => 'ditolak',
                'vv' => 'berkas'
            );
            
            $user = User::find($valid->id_user);
            Mail::to($user->email)->send(new SendGmail($data));
            return back();
        }
    }

    public function validtracer(Request $request){
        $rules = [
            'jenis' => 'required'
        ];

        $messages = [
            'jenis.required' => 'Silahkan pilih jenis validasi!'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
  
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }

        if($request->jenis == 'Valid') {
            $valid = PRF::find($request->id);
            $valid->status = 'Valid';
            $valid->update();
            
            $data = array(
                'status' => 'diterima',
                'vv' => 'tracer'
            );
            
            $user = User::find($valid->id_user);
            Mail::to($user->email)->send(new SendGmail($data));

            return back();
        } else{
            $valid = PRF::find($request->id);
            $valid->status = 'Ditolak';
            $valid->update();

            $data = array(
                'status' => 'ditolak',
                'vv' => 'tracer'
            );
            
            $user = User::find($valid->id_user);
            Mail::to($user->email)->send(new SendGmail($data));

            return back();
        }
    }

    public function pl() {
        $MK = PMSN::where('status', 'Menunggu Konfirmasi')->orWhere('status','Menunggu Pembayaran')->get();
        $SD = PMSN::where('status', 'Sedang Diproses')->get();
        $DK = PMSN::where('status', 'Dikirim')->orWhere('status','Dapat Diambil')->get();
        return view('admin.permintaan', compact('MK','SD','DK'));
    }

    public function kk($id) {
        $pesan = PMSN::find($id);
        $pesan->status = 'Sedang Diproses';
        $pesan->update();

        if($pesan->pengiriman == 'Diambil') {
            $berkas = DBS::find($pesan->id_berkas);
            $data = array(
                'pengiriman' => $pesan->pengiriman,
                'jenis' => $berkas->jenis_berkas,
                'file' => $berkas->berkas,
                'status' => 'Sedang Diproses'
            );
            
            $user = User::find($pesan->id_user);
            Mail::to($user->email)->send(new psnda($data));
            return back();
        }else{
            $berkas = DBS::find($pesan->id_berkas);
            $data = array(
                'pengiriman' => $pesan->pengiriman,
                'jenis' => $berkas->jenis_berkas,
                'file' => $berkas->berkas,
                'status' => 'Sedang Diproses'
            );
            
            $user = User::find($pesan->id_user);
            Mail::to($user->email)->send(new psn($data));
            return back();
        }
    }

    public function prosesambil($id) {
        $pesan = PMSN::find($id);
        $pesan->status = 'Dapat Diambil';
        $pesan->update();

        $berkas = DBS::find($pesan->id_berkas);
            $data = array(
                'pengiriman' => $pesan->pengiriman,
                'jenis' => $berkas->jenis_berkas,
                'file' => $berkas->berkas,
                'status' => 'Dapat Diambil'
            );
            
            $user = User::find($pesan->id_user);
            Mail::to($user->email)->send(new psnda($data));
            return back();
    }

    public function proseskirim(Request $request) {
        $pesan = PMSN::find($request->id);
        $pesan->status = 'Dikirim';
        $pesan->update();

        $kirim = PNGR::where('id_pemesan', $request->id)->first();
        $kirim->resi = $request->resi;
        $kirim->update();

        $berkas = DBS::find($pesan->id_berkas);
            $data = array(
                'pengiriman' => $pesan->pengiriman,
                'jenis' => $berkas->jenis_berkas,
                'file' => $berkas->berkas,
                'status' => 'Dikirim',
                'resi' => $request->resi
            );
            
            $user = User::find($pesan->id_user);
            Mail::to($user->email)->send(new psn($data));
            return back();
    }

    public function done(Request $request){
        $data = PMSN::find($request->id);
        $data->status = 'Selesai';
        $data->update();

        $tambah = PRF::where('id_user', $data->id_user)->first();
        $w = $tambah->total_pemesanan+1;
        $tambah->total_pemesanan = $w;
        $tambah->update();
        return back();
    }
}
