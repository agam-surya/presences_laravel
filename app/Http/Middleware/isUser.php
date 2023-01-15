<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Role;
use Illuminate\Http\Request;

class isUser
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
        
        try {
            //code...
            if(auth()->user()->role->name !=  'user'){
                return redirect('/dashboard');
            }
            return $next($request);
        } catch (\Throwable $th) {
            //throw $th;
            return redirect('/login')->with('error', $th->getMessage());
        }
    }
}
