<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Closure;

class Post
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
        if (Auth::check()) 
        {
            if (Auth::user()->isPost()) 
            {
                return $next($request);       
            }
        }
    
        Session::put('checklog', 'post');
        
        return redirect('/login');
    }
}
