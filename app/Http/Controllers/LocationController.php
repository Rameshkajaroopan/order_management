<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Location;

class LocationController extends Controller
{
    public function index()
    {
        $locations =  Location::get();
       
        return view('location.index', ['locations' => $locations]);
    }

    public function create()
    {
        return view('location.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'branch_id' => 'required',
        ]);

        $locations = new Location;
        $locations->name = $request->input('name');
        $locations->save();

        return Redirect('/location');
    }

    public function edit($id)
    {
        $location = Location::find($id);

        return view('location.edit')->with('location',$location);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
           
        ]);

        $locations =  Location::find($id);
        $locations->name = $request->input('name');
        $locations->save();

        return Redirect('/location');
    }

    public function destroy($id)
    {
        $locations = Location::find($id);
        $locations->delete();
        return redirect('/location');
    }
}
