<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\Destination;

class CalculatorController extends Controller
{
    public function index()
    {
        $vehicles = Vehicle::where('is_available', true)
            ->select('id', 'name', 'price_per_day', 'price_per_week', 'price_per_month')
            ->get();

        $destinations = Destination::where('is_active', true)
            ->select('id', 'name', 'fee_per_day')
            ->orderBy('name')
            ->get();

        return view('calculator', [
            'vehicles' => $vehicles,
            'destinations' => $destinations,
        ]);
    }
}
