<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ContractorMiddleware
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
        $auth_user_type = Auth::user()->type;// get the type of user loged in

        if(Auth::user()->type==="contractor"){
            if(Auth::user()->companyProfile==null){
                return redirect()->route('contractor.profile');
            }else{
                return $next($request);
            }
        }else{
            Session::flush();
            return redirect()->route('login');
        }
    }
}
