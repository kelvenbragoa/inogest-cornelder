<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AreaManutencao
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        {
            if(Auth::user()->role->name == "eletrica" || Auth::user()->role->name == "equipamentos_rolantes" || Auth::user()->role->name == "guindastes" || Auth::user()->role->name == "graneis_palamenta" || Auth::user()->role->name == "salubridade" || Auth::user()->role->name == "armazem" || Auth::user()->role->name == "admin_planificacao"){ 
                return $next($request);
            }else{
                return redirect()->back();
            }
        }
    }
}
