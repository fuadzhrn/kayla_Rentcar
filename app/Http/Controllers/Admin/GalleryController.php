<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::orderBy('sort_order', 'asc')
            ->orderBy('created_at', 'desc')
            ->paginate(15);
        
        return view('admin.gallery.index', ['galleries' => $galleries]);
    }

    public function create()
    {
        return view('admin.gallery.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
            'is_featured' => 'nullable|boolean',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('gallery', $filename, 'public');
            
            $latestSort = Gallery::max('sort_order') ?? 0;
            
            Gallery::create([
                'title' => $validated['title'] ?? 'Photo ' . date('Y-m-d H:i:s'),
                'description' => $validated['description'],
                'image_path' => 'gallery/' . $filename,
                'is_featured' => $validated['is_featured'] ?? false,
                'sort_order' => $latestSort + 1,
            ]);
        }

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Foto berhasil ditambahkan ke galeri');
    }

    public function edit(Gallery $gallery)
    {
        return view('admin.gallery.edit', ['gallery' => $gallery]);
    }

    public function update(Request $request, Gallery $gallery)
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'is_featured' => 'nullable|boolean',
            'sort_order' => 'nullable|integer',
        ]);

        $data = [
            'title' => $validated['title'] ?? $gallery->title,
            'description' => $validated['description'],
            'is_featured' => $validated['is_featured'] ?? false,
            'sort_order' => $validated['sort_order'] ?? $gallery->sort_order,
        ];

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('gallery', $filename, 'public');
            
            $data['image_path'] = 'gallery/' . $filename;
        }

        $gallery->update($data);

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Foto galeri berhasil diupdate');
    }

    public function destroy(Gallery $gallery)
    {
        $gallery->delete();

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Foto galeri berhasil dihapus');
    }

    public function updateSort(Request $request)
    {
        $galleries = $request->get('galleries', []);
        
        foreach ($galleries as $index => $gallery) {
            Gallery::find($gallery['id'])->update(['sort_order' => $index + 1]);
        }

        return response()->json(['success' => true, 'message' => 'Urutan galeri berhasil diupdate']);
    }
}
