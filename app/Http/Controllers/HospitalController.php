<?php

namespace App\Http\Controllers;

use App\Models\Hospital;
use App\Models\Location;
use Illuminate\Http\Request;

class HospitalController extends Controller
{
    public function showLocations()
    {
        $locations = Location::all();
        return view('hospitals.locations', compact('locations'));
    }

    public function showHospitals($locationSlug)
    {
        $location = Location::where('slug', $locationSlug)->firstOrFail();
        $hospitals = Hospital::where('location_id', $location->id)->get();
        return view('hospitals.list', compact('location', 'hospitals'));
    }

    public function showHospitalDoctors($slug)
    {
        $hospital = Hospital::with('doctors.specialization')->where('slug', $slug)->firstOrFail();
        return view('hospitals.show', compact('hospital'));
    }
}
