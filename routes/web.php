<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\HospitalController;

// Home Page
Route::get('/', [HomeController::class, 'index'])->name('home');

// ==================== Doctor Flow ====================

// Show all locations for Doctor flow
Route::get('/doctors', [DoctorController::class, 'showLocations'])->name('doctor.locations');

// Show specializations in a specific location
Route::get('/doctors/{locationSlug}', [DoctorController::class, 'showSpecializations'])->name('doctor.specializations');

// Show doctors in a specific location and specialization
Route::get('/doctors/{locationSlug}/{specializationSlug}', [DoctorController::class, 'showDoctors'])->name('doctor.list');

// Show single doctor profile
Route::get('/{doctorSlug}', [DoctorController::class, 'showDoctorProfile'])->name('doctor.profile');




// ==================== Hospital Flow ====================

// Show all locations for Hospital flow
Route::get('/hospital', [HospitalController::class, 'showLocations'])->name('hospital.locations');

// Show hospitals in a specific location
Route::get('/hospitals-in-{locationSlug}', [HospitalController::class, 'showHospitals'])->name('hospital.list');

// Show specific hospital and doctors inside it
Route::get('/{hospitalSlug}', [HospitalController::class, 'showHospitalDoctors'])->name('hospital.details');
