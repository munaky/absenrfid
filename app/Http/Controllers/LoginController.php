<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UsersModel;

class LoginController extends Controller
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param
     */

    public function login(Request $request){
        info('controller LoginController login ----------');

        $username = $request->input('username');
        $password = $request->input('password');

        $user = UsersModel::where([['username', $username], ['password', $password]])->first();

        if($user == null){
            return redirect("/auth/logout");
        }

        session(['nama' => $user->nama, 'username' => $username, 'password' => $password, 'level' => $user->level]);
        session()->save();

        return redirect("/dashboard");
    }

    public function logout(){
        info('controller LoginController logout ----------');
        session()->flush();
        return redirect('/auth/login');
    }
}
