<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use Hash;
use Session;
use App\Models\User;
use App\Models\PRF;
use App\Models\PMSN;
use App\Models\PNGR;

class AuthController extends Controller
{
    public function showFormLogin()
    {
        if (Auth::check()) { 
            return redirect()->route('home');
        }
        return view('login.login');
    }
  
    public function login(Request $request)
    {
        $rules = [
            'email'                 => 'required|email',
            'password'              => 'required|string'
        ];
  
        $messages = [
            'email.required'        => 'Email wajib diisi',
            'email.email'           => 'Email tidak valid',
            'password.required'     => 'Password wajib diisi',
            'password.string'       => 'Password harus berupa string'
        ];
  
        $validator = Validator::make($request->all(), $rules, $messages);
  
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }
  
        $data = [
            'email'     => $request->input('email'),
            'password'  => $request->input('password'),
        ];
  
        Auth::attempt($data);
  
        if (Auth::check()) { 
            return redirect()->route('home');
  
        } else { 
            Session::flash('error', 'Email atau password salah');
            return redirect()->route('login');
        }
  
    }
  
    public function showFormRegister()
    {
        return view('login.register');
    }
  
    public function register(Request $request)
    {
        $rules = [
            'name'                  => 'required|min:3|max:35',
            'email'                 => 'required|email|unique:users,email',
            'password'              => 'required|confirmed'
        ];
  
        $messages = [
            'name.required'         => 'Nama Lengkap wajib diisi',
            'name.min'              => 'Nama lengkap minimal 3 karakter',
            'name.max'              => 'Nama lengkap maksimal 35 karakter',
            'email.required'        => 'Email wajib diisi',
            'email.email'           => 'Email tidak valid',
            'email.unique'          => 'Email sudah terdaftar',
            'password.required'     => 'Password wajib diisi',
            'password.confirmed'    => 'Password tidak sama dengan konfirmasi password'
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
        $user->role = "3";
        $simpan = $user->save();
  
        if($simpan){
            Session::flash('success', 'Register berhasil! Silahkan login untuk mengakses data');
            return redirect()->route('login');
        } else {
            Session::flash('errors', ['' => 'Register gagal! Silahkan ulangi beberapa saat lagi']);
            return redirect()->route('register');
        }
    }
  
    public function logout()
    {
        Auth::logout(); 
        return redirect()->route('login');
    }

    public function index() {
        if(Auth::user()->role == 1) {
            return view('superadmin.superadmin');
        }elseif(Auth::user()->role == 2) {
            return view('admin.dashboard');
        }else{
            $hapus = PMSN::where('id_user',Auth::user()->id)->where('status','Ditunda')->get();
            foreach ($hapus as $data) {
                $kirim = PNGR::where('id_pemesan', $data->id)->get();
                if($kirim->isEmpty()){
                    $hapus->each->delete();
                }else{
                    $kirim->each->delete();
                    $hapus->each->delete();
                }
            }
            $TS = PRF::where('id_user',Auth::user()->id)->get();
            $AT = PRF::where('id_user',Auth::user()->id)->first();
            return view('user.usdashboard', compact('TS','AT'));
        }
    }

    public function gp() {
        return view('login.gp');
    }

    public function gpass(Request $request) {
        $rules = [
            'lpass'                 => 'required',
            'password'              => 'required|confirmed'
        ];
  
        $messages = [
            'lpass.required'        => 'Silahkan isi password lama anda',               
            'password.required'     => 'Password wajib diisi',
            'password.confirmed'    => 'Password tidak sama dengan konfirmasi password'
        ];
  
        $cek = User::find($request->id);
        $validator = Validator::make($request->all(), $rules, $messages);

        if(Hash::check($request->lpass, $cek->password)) {
            if($validator->fails()){
                return redirect()->back()->withErrors($validator)->withInput($request->all);
            }
            $edit = User::find($request->id);
            $edit->password = Hash::make($request->password);
            $edit->update();
            Session::flash('success', 'Berhasil memperbaharui data');
            return back();
        }else{
            Session::flash('error', 'Password lama anda tidak cocok');
            return back();
        }
    }
    
}
