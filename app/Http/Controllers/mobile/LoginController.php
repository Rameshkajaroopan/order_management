<?php

namespace App\Http\Controllers\mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\User;



class LoginController extends Controller
{
    public function sendResponse($result, $message)
    {
        $response = [
            'success' => true,
            'data'    => $result,
            'message' => $message,
        ];


        return response()->json($response, 200);
    }

    public function index()
    {
        return response()->json(['message' => 'login panunga']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createLogin(Request $request)
    {


        $request->validate([
            'c' => 'required',
            'password' => 'required',
        ]);

        if (User::where('user_name', $request->user_name)->value('role') != 'admin') {
            $credentials = $request->only('user_name', 'password');

            if (Auth::attempt($credentials)) {

                /** @var \App\Models\MyUserModel $user **/
                $user = Auth::user();
                $token  = $user->createToken('tokens')->plainTextToken;
                return response()->json(['token' => $token]);
                // return redirect('/api/dashboard');
            }
            return response()->json(['message' => 'Not successfuly login']);
        }
        return response()->json(['message' => 'You can not login by user]);
       
    }

    public function logout()
    {

        Session::flush();

        Auth::logout();

        return response()->json(['message' => 'Your successfully logout']);
    }
}
