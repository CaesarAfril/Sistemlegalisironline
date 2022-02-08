<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use Hash;
use Session;
use Storage;
use App\Models\User;
use App\Models\PRF;
use App\Models\DBS;
use App\Models\DPS;
use App\Models\PMSN;
use App\Models\PNGR;
use App\Models\City;
use App\Models\Province;
use Kavist\RajaOngkir\Facades\RajaOngkir;
use Mail;
use App\Mail\psnda;
use App\Mail\psn;

class UserController extends Controller
{
    public function showprofil() {
        $count = PRF::where('id_user', Auth::user()->id)->count();
        if($count == null) {
            $data = DPS::all();
            return view('user.fl', compact('data'));
        }else{
            $prof = PRF::where('id_user',Auth::user()->id)->first();
            $data = DPS::all();
            $use  = User::find(Auth::user()->id);
            $hapus = PMSN::where('id_user',Auth::user()->id)->where('status','Ditunda')->get();
            foreach ($hapus as $ee) {
                $kirim = PNGR::where('id_pemesan', $ee->id)->get();
                if($kirim->isEmpty()){
                    $hapus->each->delete();
                }else{
                    $kirim->each->delete();
                    $hapus->each->delete();
                }
            }
            return view('user.prfl', compact('prof', 'data','use'));
        }
    }

    public function profil(Request $request) {
       $rules = [
           'name'   => 'required',
           'NIM'    => 'required|min:9|max:9',
           'progdi' => 'required',
           'tahun'  => 'required'
       ];
       
       $messages = [
           'name.required'  => 'Nama Lengkap Wajib Diisi',
           'NIM.required'   => 'NIM Wajib Diisi',
           'NIM.min'        => 'Jumlah Karakter pada NIM yaitu 9 Karakter',
           'NIM.max'        => 'Jumlah Karakter pada NIM yaitu 9 Karakter',
           'progdi.required'=> 'Program Studi Wajib Diisi',
           'tahun.required' => 'Tahun Lulus Wajib Diisi'
       ];

       $validator = Validator::make($request->all(), $rules, $messages);

       if($validator->fails()){
        return redirect()->back()->withErrors($validator)->withInput($request->all);
        }

        $profil = new PRF;
        $profil->nama_lengkap = ucwords(strtolower($request->name));
        $profil->NIM = $request->NIM;
        $profil->program_studi = $request->progdi;
        $profil->tahun_lulus = $request->tahun;
        $profil->status = "Belum mengupload";
        $profil->id_user = Auth::user()->id;
        $simpan = $profil->save();

        if($simpan){
            Session::flash('success', 'Berhasil mengisi data diri');
            return back();
        } else {
            Session::flash('errors', ['' => 'Pengisian data diri gagal! Silahkan ulangi beberapa saat lagi']);
            return redirect()->route('profil');
        }
    }

    public function showdaftarberkas() {
        $data = DBS::where('id_user', Auth::user()->id)->get();
        $hapus = PMSN::where('id_user',Auth::user()->id)->where('status','Ditunda')->get();
            foreach ($hapus as $ee) {
                $kirim = PNGR::where('id_pemesan', $ee->id)->get();
                if($kirim->isEmpty()){
                    $hapus->each->delete();
                }else{
                    $kirim->each->delete();
                    $hapus->each->delete();
                }
            }
        return view('user.daftarberkas', compact('data'));
    }

    public function daftarberkas(Request $request) {
        $rules = [
            'jenis'          => 'required',
            'nomorberkas'    => 'required',
            'berkas'         => 'required|max:1040|mimes:doc,docx,PDF,pdf',
            'validator'      => 'required|mimes:doc,docx,PDF,pdf,jpg,jpeg,png|max:1040'
        ];
        
        $messages = [
            'jenis.required'            => 'Jenis Berkas Wajib Dipilih',
            'nomorberkas.required'      => 'Nomor Berkas Wajib Diisi',
            'berkas.required'           => 'Silahkan Upload Berkas',
            'berkas.max'                => 'Maksimal file 1 MB',
            'validator.max'             => 'Maksimal file 1 MB',
            'berkas.mimes'              => 'Format file salah',
            'validator.mimes'           => 'Format file salah',
            'validator.required'        => 'Silahkan Upload Validator Berupa KTM atau KTM Lulus'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }

        $namber = $request->file('berkas')->getClientOriginalName();
        $valid = $request->file('validator')->getClientOriginalName();
        Storage::putFileAs('public/validator', $request->file('validator'), $valid);

        if ($request->jenis == "Akta IV"){
            Storage::putFileAs('public/Akta IV', $request->file('berkas'), $namber);
        }elseif($request->jenis == "Transkrip Nilai"){
            Storage::putFileAs('public/Transkrip', $request->file('berkas'), $namber);
        }else{
            Storage::putFileAs('public/Ijazah', $request->file('berkas'), $namber);
        }

        $berkas = new DBS;
        $berkas->jenis_berkas = $request->jenis;
        $berkas->nomor_berkas = $request->nomorberkas;
        $berkas->berkas = $namber;
        $berkas->validator = $valid;
        $berkas->status = "belum";
        $berkas->id_user = Auth::user()->id;
        $simpan = $berkas->save();

        if($simpan){
            Session::flash('success', 'Berhasil mengupload berkas');
            return back();
        } else {
            Session::flash('errors', ['' => 'Upload berkas gagal! Silahkan ulangi beberapa saat lagi']);
            return back();
        }
    }

    public function showpermintaanlegalisir() {
        $data = DBS::where('id_user', Auth::user()->id)->get();
        $hapus = PMSN::where('id_user',Auth::user()->id)->where('status','Ditunda')->get();
            foreach ($hapus as $ee) {
                $kirim = PNGR::where('id_pemesan', $ee->id)->get();
                if($kirim->isEmpty()){
                    $hapus->each->delete();
                }else{
                    $kirim->each->delete();
                    $hapus->each->delete();
                }
            }
        $data = DBS::where('id_user', Auth::user()->id)->get();
        return view('user.permintaanlegalisir', compact('data'));
    }

    public function hapusberkas($id){
        $berkas = DBS::find($id);
        if($berkas->jenis_berkas == "Akta IV") {
            Storage::delete('public/Akta IV/'.$berkas->berkas);
        }elseif ($berkas->jenis_berkas == "Transkrip Nilai") {
            Storage::delete('public/Transkrip/'.$berkas->berkas);
        }else{
            Storage::delete('public/Ijazah/'.$berkas->berkas);
        }
        Storage::delete('public/validator/'.$berkas->validator);
        $berkas->delete();
        return back();
    }

    public function editberkas(Request $request) {
        if($request->hasFile('berkas')) {
            $rules = [
                'berkas'         => 'required|max:1040|mimes:doc,docx,PDF,pdf',
                'enomorberkas'    => 'required',
                'validator'      => 'required|mimes:doc,docx,PDF,pdf,jpg,jpeg,png|max:1040'
            ];
            
            $messages = [
                'berkas.required'           => 'Silahkan Upload Berkas',
                'enomorberkas.required'      => 'Nomor Berkas Wajib Diisi',
                'berkas.max'                => 'Maksimal file 1 MB',
                'validator.max'             => 'Maksimal file 1 MB',
                'berkas.mimes'              => 'Format file salah',
                'validator.mimes'           => 'Format file salah',
                'validator.required'        => 'Silahkan Upload Validator Berupa KTM atau KTM Lulus'
            ];
    
            $validator = Validator::make($request->all(), $rules, $messages);
    
            if($validator->fails()){
                return redirect()->back()->withErrors($validator)->withInput($request->all);
            }
            $a = DBS::find($request->id);
            if($a->jenis_berkas == "Akta IV") {
                Storage::delete('public/Akta IV/'.$a->berkas);
            }elseif ($a->jenis_berkas == "Transkrip Nilai") {
                Storage::delete('public/Transkrip/'.$a->berkas);
            }else{
                Storage::delete('public/Ijazah/'.$a->berkas);
            }
            Storage::delete('public/validator/'.$a->validator);

            $namber = $request->file('berkas')->getClientOriginalName();
            $valid = $request->file('validator')->getClientOriginalName();
            Storage::putFileAs('public/validator', $request->file('validator'), $valid);

            if ($a->jenis == "Akta IV"){
                Storage::putFileAs('public/Akta IV', $request->file('berkas'), $namber);
            }elseif($a->jenis == "Transkrip Nilai"){
                Storage::putFileAs('public/Transkrip', $request->file('berkas'), $namber);
            }else{
                Storage::putFileAs('public/Ijazah', $request->file('berkas'), $namber);
            }

            $a->nomor_berkas = $request->enomorberkas;
            $a->berkas = $namber;
            $a->validator = $valid;
            $a->status = "belum";
            $a->update();
            return back();
        }else{
            if($request->hasFile('validator')) {
                if($request->filled('enomorberkas')){
                    $a = DBS::find($request->id);
                    Storage::delete('public/validator/'.$a->validator);

                    $valid = $request->file('validator')->getClientOriginalName();
                    Storage::putFileAs('public/validator', $request->file('validator'), $valid);

                    $a->nomor_berkas = $request->enomorberkas;
                    $a->validator = $valid;
                    $a->status = "belum";
                    $a->update();
                    return back();
                }else{
                    $a = DBS::find($request->id);
                    Storage::delete('public/validator/'.$a->validator);

                    $valid = $request->file('validator')->getClientOriginalName();
                    Storage::putFileAs('public/validator', $request->file('validator'), $valid);
                    
                    $a->status = "belum";
                    $a->update();
                    return back();
                }
            }else{
                $a = DBS::find($request->id);
                $a->nomor_berkas = $request->enomorberkas;
                $a->status = "belum";
                $a->update();
                return back();
            }
        }
    }

    public function permintaanlegalisir(Request $request){
        $provinces = Province::pluck('name', 'province_id');
        if($request->jenis == 'Diambil'){
            $pesan = new PMSN;
            $pesan->pengiriman = $request->jenis;
            $pesan->id_berkas = $request->id;
            $pesan->jumlah = $request->jumlah;
            $pesan->status = "Menunggu Konfirmasi";
            $pesan->id_user = Auth::user()->id;
            $simpan = $pesan->save();
            
            $berkas = DBS::find($request->id);
            $data = array(
                'pengiriman' => $request->jenis,
                'jenis' => $berkas->jenis_berkas,
                'file' => $berkas->berkas,
                'status' => 'Menunggu Konfirmasi'

            );
            
            $user = User::find(Auth::user()->id);
            Mail::to($user->email)->send(new psnda($data));
            return back();
        }else{
            $pesan = new PMSN;
            $pesan->pengiriman = $request->jenis;
            $pesan->id_berkas = $request->id;
            $pesan->jumlah = $request->jumlah;
            $pesan->status = "Ditunda";
            $pesan->id_user = Auth::user()->id;
            $simpan = $pesan->save();
            $data= $pesan->id;
            
            return view('user.pengiriman', compact('data','provinces'));
        }
    }

    public function kiriman(Request $request){
        $psn = PMSN::find($request->id);
        $kota = City::where('city_id',$request->city_destination)->first();
        $provinsi = Province::where('province_id',$request->province_destination)->first();
        $harga = $psn->jumlah*1500;
        $kirim = new PNGR;
        $kirim->kota = $kota->name;
        $kirim->jumlah = $psn->jumlah;
        $kirim->provinsi= $provinsi->name;
        $kirim->id_pemesan = $psn->id;
        $kirim->ekspedisi = $request->service;
        $kirim->harga = $request->harga+$harga;
        $kirim->id_user = Auth::user()->id;
        $simpan = $kirim->save();
        $id = $kirim->id;

        return view('user.endpemesanan', compact('id'));
    }

    public function endpesan(Request $request) {
        $data = PNGR::find($request->id);
        $data->alamat = $request->alamat;
        $data->kode_pos = $request->kodepos;
        $data->update();

        $pesan = PMSN::find($data->id_pemesan);
        $pesan->status = "Menunggu Pembayaran";
        $pesan->update();

        $berkas = DBS::find($pesan->id_berkas);
            $data = array(
                'pengiriman' => $request->jenis,
                'jenis' => $berkas->jenis_berkas,
                'file' => $berkas->berkas,
                'kota' => $data->kota,
                'provinsi' => $data->provinsi,
                'alamat' => $request->alamat,
                'kode' => $request->kodepos,
                'harga' => $data->harga,
                'eks' => $data->ekspedisi,
                'jumlah' => $data->jumlah,
                'status' => 'bayar'

            ); 
            $user = User::find(Auth::user()->id);
            Mail::to($user->email)->send(new psn($data));
        Session::flash('success', 'Berhasil melakukan Pemesanan');
        return redirect()->route('permintaanlegalisir');
    }

    public function hapuspemesanan($id){
        $kirim = PNGR::find($request->id);
        $pesan = PMSN::find($kirim->id_pemesan);
        $kirim->delete();
        $pesan->delete();
        return redirect()->route('permintaanlegalisir');
    }

    public function inputtracer(Request $request){
        $rules = [
                'tracers'         => 'required|max:1040|mimes:doc,docx,PDF,pdf,jpg,jpeg,png'
            ];
            
            $messages = [
                'tracers.required'           => 'Silahkan Upload Berkas',
                'tracers.max'                => 'Maksimal file 1 MB',
                'tracers.mimes'              => 'Format file salah',
            ];
    
            $validator = Validator::make($request->all(), $rules, $messages);
    
            if($validator->fails()){
                return redirect()->back()->withErrors($validator)->withInput($request->all);
            }
        $nama = $request->file('tracers')->getClientOriginalName();
        Storage::putFileAs('public/tracer', $request->file('tracers'), $nama);

        $trace = PRF::where('id_user',Auth::user()->id)->first();
        if($trace != null) {
            Storage::delete('public/tracer/'.$trace->tracer_study);
            $trace->tracer_study = $nama;
            $trace->status = "Belum divalidasi";
            $trace->update();
            return back();
        }else{
            $trace->tracer_study = $nama;
            $trace->status = "Belum divalidasi";
            $trace->update();
            return back();
        }
        
    }

    public function tc() {
        return view('user.tracer');
    }

    public function epf(Request $request){
        $edit = PRF::find($request->id);
        $edit->nama_lengkap = $request->name;
        $edit->NIM = $request->NIM;
        $edit->program_studi = $request->progdi;
        $edit->tahun_lulus = $request->tahun;
        $edit->update();
        Session::flash('success', 'Berhasil memperbaharui data');
        return back();
    }

    public function pemesanan() {
        $data = DBS::where('id_user', Auth::user()->id)->get();
        $hapus = PMSN::where('id_user',Auth::user()->id)->where('status','Ditunda')->get();
            foreach ($hapus as $ee) {
                $kirim = PNGR::where('id_pemesan', $ee->id)->get();
                if($kirim->isEmpty()){
                    $hapus->each->delete();
                }else{
                    $kirim->each->delete();
                    $hapus->each->delete();
                }
            }
        $data = PMSN::where('id_user',Auth::user()->id)->where('status','!=','Selesai')->get();
        $sele = PMSN::where('id_user',Auth::user()->id)->where('status','Selesai')->get();
        return view('user.pemesanan',compact('data','sele'));
    }

    public function batalpesan($id) {
        $pesan = PMSN::find($id);
        if($pesan->pengiriman == 'Diambil') {
            $pesan->delete();
        }else{
            $kirim = PNGR::where('id_pemesan',$id)->first();
            $kirim->delete();
            $pesan->delete();
        }
        
        return redirect()->route('pemesanan');
    }

    public function buktibayar(Request $request) {
        $rules = [
                'bb'         => 'required|max:1040|mimes:doc,docx,PDF,pdf,jpg,jpeg,png'
            ];
            
            $messages = [
                'bb.required'           => 'Silahkan Upload Berkas',
                'bb.max'                => 'Maksimal file 1 MB',
                'bb.mimes'              => 'Format file salah',
            ];
    
            $validator = Validator::make($request->all(), $rules, $messages);
    
            if($validator->fails()){
                return redirect()->back()->withErrors($validator)->withInput($request->all);
            }
        $valid = $request->file('bb')->getClientOriginalName();
        Storage::putFileAs('public/Bukti', $request->file('bb'), $valid);
        $pesan = PMSN::find($request->id);
        $pesan->bukti_pembayaran = $valid;
        $pesan->status = 'Menunggu Konfirmasi';
        $pesan->update();

        $berkas = DBS::find($pesan->id_berkas);
        $data = array(
            'pengiriman' => 'Dikirim',
            'jenis' => $berkas->jenis_berkas,
            'file' => $berkas->berkas,
            'status' => 'Menunggu Konfirmasi'

        ); 
        $user = User::find(Auth::user()->id);
        Mail::to($user->email)->send(new psn($data));
        Session::flash('success', 'Berhasil upload bukti pembayaran, silahkan tunggu admin untuk konfirmasi pemesanan');
        return redirect()->route('pemesanan');
    }

    public function done(Request $request){
        $aa = PMSN::find($request->id);
        $aa->status = 'Selesai';
        $aa->update();

        $tambah = PRF::where('id_user', Auth::user()->id)->first();
        $w = $tambah->total_pemesanan+1;
        $tambah->total_pemesanan = $w;
        $tambah->update();
        
        $berkas = DBS::find($aa->id_berkas);

        if($aa->status == 'Dikirim') {
            $data = array(
                'pengiriman' => 'Dikirim',
                'jenis' => $berkas->jenis_berkas,
                'file' => $berkas->berkas,
                'status' => 'Selesai'
    
            ); 
            $user = User::where('id',$aa->id_user)->first();
            Mail::to($user->email)->send(new psn($data));
        }else{
            $data = array(
                'pengiriman' => $request->jenis,
                'jenis' => $berkas->jenis_berkas,
                'file' => $berkas->berkas,
                'status' => 'Selesai'

            );
            
            $user = User::where('id',$aa->id_user)->first();
            Mail::to($user->email)->send(new psnda($data));
        }
        return back();
    }
}
