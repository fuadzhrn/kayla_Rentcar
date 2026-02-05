<?php

namespace App\Http\Controllers;

use App\Models\Gallery;

class GalleryPageController extends Controller
{
    public function index()
    {
        $galleries = Gallery::where('is_featured', true)
            ->orderBy('sort_order', 'asc')
            ->get();

        $allGalleries = Gallery::orderBy('sort_order', 'asc')
            ->get();

        return view('gallery', [
            'galleries' => $galleries,
            'allGalleries' => $allGalleries,
        ]);
    }
}
