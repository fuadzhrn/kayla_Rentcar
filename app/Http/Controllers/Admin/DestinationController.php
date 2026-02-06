<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use Illuminate\Http\Request;

class DestinationController extends Controller
{
    public function index()
    {
        $destinations = Destination::orderBy('name')->paginate(10);
        return view('admin.destinations.index', ['destinations' => $destinations]);
    }

    public function create()
    {
        return view('admin.destinations.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:destinations,name',
            'fee_per_day' => 'required|numeric|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['is_active'] = $request->has('is_active') ? true : false;

        Destination::create($validated);

        return redirect()->route('admin.destinations.index')
            ->with('success', 'Tujuan perjalanan berhasil ditambahkan');
    }

    public function show(Destination $destination)
    {
        return view('admin.destinations.show', ['destination' => $destination]);
    }

    public function edit(Destination $destination)
    {
        return view('admin.destinations.edit', ['destination' => $destination]);
    }

    public function update(Request $request, Destination $destination)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:destinations,name,' . $destination->id,
            'fee_per_day' => 'required|numeric|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['is_active'] = $request->has('is_active') ? true : false;

        $destination->update($validated);

        return redirect()->route('admin.destinations.index')
            ->with('success', 'Tujuan perjalanan berhasil diupdate');
    }

    public function destroy(Destination $destination)
    {
        $destination->delete();

        return redirect()->route('admin.destinations.index')
            ->with('success', 'Tujuan perjalanan berhasil dihapus');
    }
}
