<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Location;
use App\Models\Branch;


class LocationController extends Controller
{
    public function index()
    {
        $branches =  Branch::get();

        $locations =  Location::get();

        return view('location.index', ['locations' => $locations, 'branches' => $branches]);
    }

    public function create()
    {
        return view('location.add');
    }

    public function store(Request $request)
    {

        Location::create($request->all());


        return Redirect('/location');
    }

    public function edit($id)
    {
        $location = Location::find($id);

        return view('location.edit')->with('location', $location);
    }

    public function update(Request $request)
    {
        Location::find($request->id)->update($request->all());

        return Redirect('/location');
    }

    public function destroy(Request $request)
    {
        $locations = Location::find($request->id);
        $locations->delete();
        return $locations;
    }

    public function locationView(Request $request)
    {
        $location = Location::find($request->id);;
        return json_encode($location);
    }
}
