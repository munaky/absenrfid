<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\UsersModel;

class LoginValidation
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
        info("middleware LoginValidation ----------");
        $response = $next($request);

        $username = session()->get('username');
        $password = session()->get('password');
        $level = session()->get('level');

        $user = UsersModel::where([['username', $username], ['password', $password], ['level', $level]])->exists();

        if(!$user){
            return redirect("/auth/logout");
        }

        return $response;
    }
}
