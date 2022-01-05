<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AdminloginController extends Controller
{

    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'user_name' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('user_name', 'password');
        if (Auth::attempt($credentials)) {

            $token = Str::random(64);
            $name  =  Auth::user()->first_name;
            DB::table('users')
                ->where('id', Auth::user()->id)
                ->update(['remember_token' =>  $token]);
            
            return redirect('/dashboard')->with('message', 'Your successfully login !');
        }
     
        return redirect('/login')->with('message', 'Your email and password does not match !');
    }

    public function logout()
    {

        Session::flush();

        Auth::logout();

        return Redirect('/login');
    }

    public function dashboard()
    {
        return  Auth::user()->email;
        return view('dashboard');
    }
}
