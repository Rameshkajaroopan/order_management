<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Branch;


class BranchController extends Controller
{
    public function index()
    {
        $branches =  Branch::get();

        return view('branch.index', ['branches' => $branches]);
    }

    public function create()
    {
        return view('branch.add');
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'location' => 'required',

        ]);

        $branches = new Branch;
        $branches->name = $request->input('name');
        $branches->location = $request->input('location');
        $branches->save();
        
        return Redirect('/branch');
       
    }

    public function edit($id)
    {
       
        $branch = Branch::find($id);

        return view('branch.edit')->with('branch', $branch);
    }

    public function update(Request $request, $id)
    {
      
        $request->validate([
            'name' => 'required',
            'location' => 'required',

        ]);

        $branches =  Branch::find($id);
        $branches->name = $request->input('name');
        $branches->location = $request->input('location');
        $branches->save();

        // return response()->json($branches);
        return Redirect('/branch');
    }

    public function destroy($id)
    {
        $branches = Branch::find($id);
        $branches->delete();
        return redirect('/branch');
    }
}
