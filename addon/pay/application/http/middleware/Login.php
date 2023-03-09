<?php

namespace app\http\middleware;

class Login
{
    public function handle($request, \Closure $next)
    {
        if (session('login_user')) {
            return $next($request);
        } else {
            return redirect('/' . USER_DIR . '/login.html');
        }
    }
}
