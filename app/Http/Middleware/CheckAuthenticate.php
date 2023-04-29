<?php

namespace App\Http\Middleware;

use Closure;

class CheckAuthenticate
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
        if (!empty(session('user_auth'))) {
            $user = session('user_auth');
            if ( isset($user->logout) && date('Y-m-d H:i',strtotime(now())) >= date('Y-m-d H:i', strtotime($user->logout)) ) {
                return redirect('/login');
            }
            return $next($request);
        }

        return redirect('/login');
    }
}
