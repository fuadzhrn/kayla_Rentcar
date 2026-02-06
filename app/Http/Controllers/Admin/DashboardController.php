<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use App\Models\VehicleImage;
use App\Models\Gallery;
use App\Models\RentalType;

class DashboardController extends Controller
{
    public function index()
    {
        $totalVehicles = Vehicle::count();
        $totalImages = VehicleImage::count();
        $availableVehicles = Vehicle::where('is_available', true)->count();
        $totalRentalTypes = RentalType::count();
        
        $recentVehicles = Vehicle::orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
        
        $vehiclesWithImages = Vehicle::whereHas('images')->count();

        return view('admin.dashboard', [
            'totalVehicles' => $totalVehicles,
            'totalImages' => $totalImages,
            'availableVehicles' => $availableVehicles,
            'totalRentalTypes' => $totalRentalTypes,
            'recentVehicles' => $recentVehicles,
            'vehiclesWithImages' => $vehiclesWithImages,
        ]);
    }

    public function settings()
    {
        return view('admin.settings');
    }
}
