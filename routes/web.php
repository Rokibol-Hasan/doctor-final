<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\HospitalController;


// ajax load
Route::get('/get-locations', function () {
    $locations = \App\Models\Location::select('name', 'slug')->get();
    return response()->json($locations);
});

// Home Page
Route::get('/', [HomeController::class, 'index'])->name('pages.home');

// ==================== Doctor Flow ====================

// Show doctors by location (e.g., /doctors-dhaka)
Route::get('/doctors-{locationSlug}', [DoctorController::class, 'showSpecializations'])->name('doctor.specializations');

// Show doctors by specialization in location (e.g., /cancer-dhaka)
Route::get('/{specializationSlug}-{locationSlug}', [DoctorController::class, 'showDoctors'])->name('doctor.list');

// Show single doctor profile
Route::get('/{doctorSlug}', [DoctorController::class, 'showDoctorProfile'])->name('doctor.profile');




// ==================== Hospital Flow ====================

// Show all locations for Hospital flow
Route::get('/hospital', [HospitalController::class, 'showLocations'])->name('hospital.locations');

// Show hospitals in a specific location
Route::get('/hospitals-in-{locationSlug}', [HospitalController::class, 'showHospitals'])->name('hospital.list');

// Show specific hospital and doctors inside it
Route::get('/{hospitalSlug}', [HospitalController::class, 'showHospitalDoctors'])->name('hospital.details');
