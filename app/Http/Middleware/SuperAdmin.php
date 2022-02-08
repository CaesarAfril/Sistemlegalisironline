<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Carbon\Carbon;

class SuperAdmin
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
        if(Auth::user()->role == '1') {
            $time = User::find(Auth::user()->id);
            $time->last_login_at = date('Y-m-d H:i:s');
            $time->update();
            return $next($request);
        }else{
            return redirect('/');
        }
        
    }
}
