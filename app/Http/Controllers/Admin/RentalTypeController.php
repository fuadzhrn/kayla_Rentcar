<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RentalType;
use Illuminate\Http\Request;

class RentalTypeController extends Controller
{
    public function index()
    {
        $rentalTypes = RentalType::orderBy('order')->paginate(10);
        return view('admin.rental-types.index', ['rentalTypes' => $rentalTypes]);
    }

    public function create()
    {
        return view('admin.rental-types.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100|unique:rental_types',
            'description' => 'required|string',
            'icon' => 'required|string|max:100',
            'order' => 'nullable|integer|min:0',
        ]);

        // If order not provided, use next available order
        if (!isset($validated['order'])) {
            $validated['order'] = RentalType::max('order') + 1 ?? 0;
        }

        RentalType::create($validated);

        return redirect()->route('admin.rental-types.index')
            ->with('success', 'Jenis layanan berhasil ditambahkan');
    }

    public function edit(RentalType $rentalType)
    {
        return view('admin.rental-types.edit', ['rentalType' => $rentalType]);
    }

    public function update(Request $request, RentalType $rentalType)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100|unique:rental_types,name,' . $rentalType->id,
            'description' => 'required|string',
            'icon' => 'required|string|max:100',
            'order' => 'nullable|integer|min:0',
        ]);

        $rentalType->update($validated);

        return redirect()->route('admin.rental-types.index')
            ->with('success', 'Jenis layanan berhasil diupdate');
    }

    public function destroy(RentalType $rentalType)
    {
        $rentalType->delete();

        return redirect()->route('admin.rental-types.index')
            ->with('success', 'Jenis layanan berhasil dihapus');
    }
}
