<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\PRF;
use Illuminate\Support\Facades\Auth;

class TracerMiddleware
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
        $validasi = PRF::where('id_user',Auth::user()->id)->first();
        if($validasi->status == 'Valid') {
            return $next($request);
        }else{
            return redirect('/tracer');
        }
        
    }
}
