<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Branch;
use App\Models\Location;


class BranchController extends Controller
{
    public function index()
    {
        $branches =  Branch::get();
        $locations = Location::get();
        return view('branch.index', ['branches' => $branches, 'locations' => $locations]);
    }

    public function create()
    {
        return view('branch.add');
    }

    public function store(Request $request)
    {
        $request->Location_id = (int)$request->Location_id;
 
        $branches = Branch::create($request->all());

        return Redirect('/branch');
    }

    public function edit($id)
    {

        $branch = Branch::find($id);

        return view('branch.edit')->with('branch', $branch);
    }

    public function update(Request $request)
    {
        $user = Branch::find($request->id)->update($request->all());
        return Redirect('/branch');
    }

    public function destroy(Request $request)
    {
        $branches = Branch::find($request->id);
        $branches->delete();
        return $branches;
    }

    public function branchView(Request $request)
    {
        $branch = Branch::find($request->id);;
        return json_encode($branch);
    }
}
