<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()

    {
        $locations = \App\Models\Location::all();
        return view('pages.home', compact('locations'));
    }
}
