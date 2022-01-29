<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Carbon\Carbon;

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

        $user = User::where('user_name', $request->user_name)
            ->where('password', $request->password)
            ->first();
        if (!isset($user)) {
            return redirect('/')->with('message', 'Your email and password does not match !');
        }

        Auth::login($user);

        $token = Str::random(64);

        DB::table('users')
            ->where('id', Auth::user()->id)
            ->update(['remember_token' =>  $token]);

        return redirect('/home')->with('message', 'Your successfully login !');
    }



    public function logout()
    {

        Session::flush();

        Auth::logout();

        return Redirect('/');
    }

    public function dashboard()
    {

        return view('home');
    }
}
