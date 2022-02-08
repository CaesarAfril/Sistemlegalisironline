<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Validator;
use Hash;
use Session;
use App\Models\DPS;
use App\Models\PRF;
use App\Models\DBS;
use Storage;

class SAController extends Controller
{
    public function dataadmin(){
        $dataa = User::where('role',2)->get();
        $datas = User::where('role',1)->get();
        return view('superadmin.dataadmin', ['data' => $dataa],['dats' => $datas]);
    }

    public function showtambahadmin(){
        return view('superadmin.tambahadmin');
    }

    public function tambahadmin(Request $request){
        $rules = [
            'name'                  => 'required|min:3|max:35',
            'email'                 => 'required|email|unique:users,email',
            'password'              => 'required|confirmed',
            'role'                  => 'required'
        ];
  
        $messages = [
            'name.required'         => 'Nama Lengkap wajib diisi',
            'name.min'              => 'Nama lengkap minimal 3 karakter',
            'name.max'              => 'Nama lengkap maksimal 35 karakter',
            'email.required'        => 'Email wajib diisi',
            'email.email'           => 'Email tidak valid',
            'email.unique'          => 'Email sudah terdaftar',
            'password.required'     => 'Password wajib diisi',
            'password.confirmed'    => 'Password tidak sama dengan konfirmasi password',
            'role.required'         => 'Pilihan role wajib diisi'
        ];
  
        $validator = Validator::make($request->all(), $rules, $messages);
  
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }
  
        $user = new User;
        $user->name = ucwords(strtolower($request->name));
        $user->email = strtolower($request->email);
        $user->password = Hash::make($request->password);
        $user->email_verified_at = \Carbon\Carbon::now();
        $user->role = $request->role;
        $simpan = $user->save();
  
        if($simpan){
            Session::flash('success', 'Register berhasil!');
            return redirect()->route('dataadmin');
        } else {
            Session::flash('errors', ['' => 'Register gagal!']);
            return redirect()->route('tambahadmin');
        }
    }

    public function dataalumni(){
        $data = User::where('role',3)->get();
        $total = PRF::count();
        return view('superadmin.dataalumni', ['data' => $data],['total' => $total]);
    }

    public function hapusakun($id){
        $user = User::find($id);
        if($user->role != 3) {
           $hapus = $user->delete();
            if($hapus) {
                Session::flash('success', 'User berhasil dihapus');
                return back();
            } else {
                Session::flash('errors',[''=>'Tidak dapat menghapus user']);
                return back();
            } 
        }else{
            $berkas = DBS::where('id_user',$user->id)->first();
            $cek = DBS::where('id_user',$user->id)->count();
            if($cek == null) {
                $hapus = $user->delete();
                if($hapus) {
                    Session::flash('success', 'User berhasil dihapus');
                    return back();
                } else {
                    Session::flash('errors',[''=>'Tidak dapat menghapus user']);
                    return back();
                }  
            }else{
                if($berkas->jenis_berkas == "Akta IV") {
                    Storage::delete('public/Akta IV/'.$berkas->berkas);
                }elseif ($berkas->jenis_berkas == "Transkrip Nilai") {
                    Storage::delete('public/Transkrip/'.$berkas->berkas);
                }else{
                    Storage::delete('public/Ijazah/'.$berkas->berkas);
                }
                Storage::delete('public/validator/'.$berkas->validator);
                $hapus = $user->delete();
                if($hapus) {
                    Session::flash('success', 'User berhasil dihapus');
                    return back();
                } else {
                    Session::flash('errors',[''=>'Tidak dapat menghapus user']);
                    return back();
                }   
            }
        }
    }

    public function showdataprogdi() {
        $data = DPS::all();
        return view('superadmin.prodi', compact('data'));
    }

    public function dataprogdi(Request $request) {
        $rules = [
            'progdi' => 'required'
        ];

        $messages = [
            'progdi.required' => 'Nama Program Studi Wajib Diisi!'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
  
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }

        $prodi = new DPS;
        $prodi->nama =  $request->progdi;
        $simpan = $prodi->save();

        if($simpan){
            Session::flash('success', 'Register berhasil!');
            return redirect()->route('dataprodi');
        } else {
            Session::flash('errors', ['' => 'Register gagal!']);
            return redirect()->route('dataprodi ');
        }
    }

    public function hapusprodi($id){
        $prodi = DPS::find($id);
        $hapus = $prodi->delete();
        if($hapus) {
            Session::flash('success', 'Progdi berhasil dihapus');
            return back();
        } else {
            Session::flash('errors',[''=>'Tidak dapat menghapus progdi']);
            return back();
        }
    }
}
