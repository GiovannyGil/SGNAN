<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckBanned
{

    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
    if(auth()->check() && (auth()->user()->status == 'DEACTIVATED')){
        $request->session()->invalidate();
            
            $request->session()->regenerateToken();

            return redirect()->route('login')->with('error', 'ERROR!. El usuario esta desactivado. por favor comunicarse con el administrador para obtener mas información. ');
    }
    
    elseif($user && $user->role->status === 'DEACTIVATED'){

            $request->session()->invalidate();
            
            $request->session()->regenerateToken();

            return redirect()->route('login')->with('error', 'ERROR!. El rol esta desactivado. por favor comunicarse con el administrador para obtener mas información. ');
        }
        return $next($request);
    }
}
