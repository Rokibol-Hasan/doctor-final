<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Location;
use App\Models\Specialization;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function showLocations()
    {
        $locations = Location::all();
        return view('doctors.locations', compact('locations'));
    }

    public function showSpecializations($locationSlug)
    {
        $location = Location::where('slug', $locationSlug)->firstOrFail();
        $specializations = Specialization::where('location_id', $location->id)->get(); // Filter by location
        return view('doctors.specializations', compact('location', 'specializations'));
    }

    public function showDoctors($specializationSlug, $locationSlug)
    {
        $location = Location::where('slug', $locationSlug)->firstOrFail();
        $specialization = Specialization::where('slug', $specializationSlug)
            ->where('location_id', $location->id)
            ->firstOrFail();
    
        $doctors = Doctor::where('location_id', $location->id)
            ->where('specialization_id', $specialization->id)
            ->get();
    
        return view('doctors.list', compact('doctors', 'location', 'specialization'));
    }
    public function showDoctorProfile($slug)
    {
        $doctor = Doctor::where('slug', $slug)
        ->with(['specialization', 'location', 'chambers']) // include chambers here
        ->firstOrFail();

    return view('doctors.profile', compact('doctor'));
    }
}
