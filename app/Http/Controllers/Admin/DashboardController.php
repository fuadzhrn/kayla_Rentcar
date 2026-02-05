<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use App\Models\VehicleImage;
use App\Models\VehicleFeature;
use App\Models\Gallery;

class DashboardController extends Controller
{
    public function index()
    {
        $totalVehicles = Vehicle::count();
        $totalImages = VehicleImage::count();
        $totalFeatures = VehicleFeature::count();
        $availableVehicles = Vehicle::where('is_available', true)->count();
        $totalGalleryPhotos = Gallery::count();
        
        $recentVehicles = Vehicle::orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
        
        $vehiclesWithImages = Vehicle::whereHas('images')->count();

        return view('admin.dashboard', [
            'totalVehicles' => $totalVehicles,
            'totalImages' => $totalImages,
            'totalFeatures' => $totalFeatures,
            'availableVehicles' => $availableVehicles,
            'totalGalleryPhotos' => $totalGalleryPhotos,
            'recentVehicles' => $recentVehicles,
            'vehiclesWithImages' => $vehiclesWithImages,
        ]);
    }

    public function settings()
    {
        return view('admin.settings');
    }
}
