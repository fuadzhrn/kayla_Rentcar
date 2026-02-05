<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\RentalType;

class VehiclePageController extends Controller
{
    public function index()
    {
        // Get available vehicles with eager loaded images
        $vehicles = Vehicle::where('is_available', true)
            ->with('images')
            ->get();

        $rentalTypes = RentalType::orderBy('order')->get();

        return view('welcome', ['vehicles' => $vehicles, 'rentalTypes' => $rentalTypes]);
    }
}
