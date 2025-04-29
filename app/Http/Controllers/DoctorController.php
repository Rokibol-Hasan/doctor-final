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
        $specializations = $location->specializations;
        return view('doctors.specializations', compact('location', 'specializations'));
    }

    public function showDoctors($locationSlug, $specializationSlug)
    {
        $location = Location::where('slug', $locationSlug)->firstOrFail();
        $specialization = Specialization::where('slug', $specializationSlug)->firstOrFail();

        $doctors = Doctor::with('chambers')
            ->where('location_id', $location->id)
            ->where('specialization_id', $specialization->id)
            ->get();

        return view('doctors.list', compact('location', 'specialization', 'doctors'));
    }

    public function showDoctorProfile($slug)
    {
        $doctor = Doctor::where('slug', $slug)
        ->with(['specialization', 'location', 'chambers']) // include chambers here
        ->firstOrFail();

    return view('doctors.profile', compact('doctor'));
    }
}
