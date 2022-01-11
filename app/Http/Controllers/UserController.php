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
    
        User::create($request->all()+['role'=> 'user']);

        return redirect('/user');
    }


    public function edit($id)
    {
        $user = User::find($id);

        return view('user.edit')->with('user', $user);
    }

    public function update(Request $request)
    {
  
        $users = User::find($request->id)->update($request->all());

        return redirect('/user');
    }

    public function destroy(Request $request)
    
    {
            $user = User::find($request->id);
            $user->delete();
            return $user;
            

    }

    public function userView(Request $request){
        $user = User::find($request->id);
        return json_encode($user);

        
    }
}
