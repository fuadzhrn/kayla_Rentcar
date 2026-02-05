<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use App\Models\VehicleImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VehicleController extends Controller
{
    public function index()
    {
        $vehicles = Vehicle::with('images')->paginate(15);
        return view('admin.vehicles.index', ['vehicles' => $vehicles]);
    }

    public function create()
    {
        return view('admin.vehicles.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:100',
            'model' => 'required|string|max:100',
            'year' => 'required|integer|min:2000|max:' . date('Y'),
            'vehicle_type' => 'required|in:Compact,Sedan,SUV,MPV,Truck',
            'transmission' => 'required|in:Manual,Automatic',
            'engine_cc' => 'required|integer',
            'fuel_type' => 'required|in:Petrol,Diesel,Hybrid',
            'seat_capacity' => 'required|integer|min:1|max:10',
            'price_per_day' => 'required|numeric|min:0',
            'price_per_week' => 'nullable|numeric|min:0',
            'price_per_month' => 'nullable|numeric|min:0',
            'description' => 'nullable|string',
            'is_available' => 'nullable|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        $vehicle = Vehicle::create($validated);

        // Handle image upload
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('vehicles', $filename, 'public');
            
            VehicleImage::create([
                'vehicle_id' => $vehicle->id,
                'image_path' => 'vehicles/' . $filename,
                'is_primary' => true,
            ]);
        }

        return redirect()->route('admin.vehicles.index')
            ->with('success', 'Kendaraan berhasil ditambahkan');
    }

    public function show(Vehicle $vehicle)
    {
        $vehicle->load('features');
        return view('admin.vehicles.show', ['vehicle' => $vehicle]);
    }

    public function edit(Vehicle $vehicle)
    {
        return view('admin.vehicles.edit', ['vehicle' => $vehicle]);
    }

    public function update(Request $request, Vehicle $vehicle)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:100',
            'model' => 'required|string|max:100',
            'year' => 'required|integer|min:2000|max:' . date('Y'),
            'vehicle_type' => 'required|in:Compact,Sedan,SUV,MPV,Truck',
            'transmission' => 'required|in:Manual,Automatic',
            'engine_cc' => 'required|integer',
            'fuel_type' => 'required|in:Petrol,Diesel,Hybrid',
            'seat_capacity' => 'required|integer|min:1|max:10',
            'price_per_day' => 'required|numeric|min:0',
            'price_per_week' => 'nullable|numeric|min:0',
            'price_per_month' => 'nullable|numeric|min:0',
            'description' => 'nullable|string',
            'is_available' => 'nullable|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        $vehicle->update($validated);

        // Handle image upload
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('vehicles', $filename, 'public');
            
            // Set previous images as non-primary
            VehicleImage::where('vehicle_id', $vehicle->id)->update(['is_primary' => false]);
            
            VehicleImage::create([
                'vehicle_id' => $vehicle->id,
                'image_path' => 'vehicles/' . $filename,
                'is_primary' => true,
            ]);
        }

        return redirect()->route('admin.vehicles.index')
            ->with('success', 'Kendaraan berhasil diupdate');
    }

    public function destroy(Vehicle $vehicle)
    {
        $vehicle->delete();

        return redirect()->route('admin.vehicles.index')
            ->with('success', 'Kendaraan berhasil dihapus');
    }
}
