<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Branch;

use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request )
    {
        $branch_status = $request->branch_status;
        $users = User::get();
       $branches = Branch::all();
        return view('user.index')->with('users',$users)->with('branches',$branches);
    }

    public function create()
    {
        return view('user.add');
    }


    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'user_name' => 'user_name',
            'email' => 'required|unique:users,email',
            'mobile' => 'required|digits:10|unique:users',
            'password' => 'required',
            'role' => 'required',
            'address' => 'required',
            'branch_id' => 'required'
        ]);

        $users = new User;
        $users->first_name = $request->input('first_name');
        $users->last_name = $request->input('last_name');
        $users->user_name = $request->input('user_name');
        $users->email = $request->input('email');
        $users->mobile = $request->input('mobile');
        $users->password = Hash::make($request->input('password'));
        $users->role = $request->input('role');
        $users->address = $request->input('address');
        $users->branch_id = $request->input('branch_id');
        $users->save();

        return redirect('/user');
    }


    public function edit($id)
    {
        $user = User::find($id);

        return view('user.edit')->with('user', $user);
    }

    public function update(Request $request)
    {
        dd($request);
        


        $users = User::find($request->id);

        $users->first_name = $request->input('first_name');
        $users->last_name = $request->input('last_name');
        $users->email = $request->input('email');
        $users->mobile = $request->input('mobile');
        $users->password = Hash::make($request->input('password'));
        $users->role = $request->input('role');
        $users->address = $request->input('address');
        $users->branch_id = $request->input('branch_id');
        $users->save();

        return redirect('/user');
    }

    public function destroy($id)
    {
            $user = User::find($id);
            $user->delete();
            return redirect('/user');
            

    }

    public function userView(Request $request){
        $user = User::find($request->id);
        return json_encode($user);

        
    }
}
