<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PRF;
use Session;

class profil
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $data = PRF::where('id_user',Auth::user()->id)->count();
        if($data != null) {
            return $next($request);
        }else{
            Session::flash('warning','Silahkan isi data diri terlebih dahulu sebelum mengakses halaman ini');
            return redirect()->route('profil');
        }
        
    }
}
