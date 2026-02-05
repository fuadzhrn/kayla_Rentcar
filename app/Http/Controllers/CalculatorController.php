<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;

class CalculatorController extends Controller
{
    public function index()
    {
        $vehicles = Vehicle::where('is_available', true)
            ->select('id', 'brand', 'model', 'price_per_day', 'price_per_week', 'price_per_month')
            ->get();

        return view('calculator', ['vehicles' => $vehicles]);
    }
}
