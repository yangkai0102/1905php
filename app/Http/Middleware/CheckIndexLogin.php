<?php

namespace App\Http\Middleware;

use Closure;

class CheckIndexLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
//        session(['user'=>null]);

//        $user=session('user');
//        dd($user);
//        if(!$user){
//        dd($request->session()->has('user'));
        if(!$request->session()->has('index')){
            return redirect('login');
        }
        return $next($request);
    }
}
