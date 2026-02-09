<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Support\Facades\Response;

class SitemapController extends Controller
{
    public function index()
    {
        // Get all vehicles
        $vehicles = Vehicle::all();
        
        // Build sitemap XML
        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

        // Homepage
        $xml .= $this->addUrl('/', '1.0', 'weekly', now()->toAtomString());

        // Gallery page
        $xml .= $this->addUrl('/gallery', '0.9', 'weekly', now()->toAtomString());

        // Calculator page
        $xml .= $this->addUrl('/calculator', '0.8', 'weekly', now()->toAtomString());

        // Add all vehicles
        foreach ($vehicles as $vehicle) {
            $url = '/calculator?vehicle=' . urlencode($vehicle->name);
            $xml .= $this->addUrl($url, '0.7', 'monthly', $vehicle->updated_at->toAtomString());
        }

        $xml .= '</urlset>';

        return Response::make($xml, 200)
            ->header('Content-Type', 'application/xml');
    }

    private function addUrl($loc, $priority, $changefreq, $lastmod)
    {
        $url = config('app.url');
        return <<<XML
    <url>
        <loc>$url$loc</loc>
        <lastmod>$lastmod</lastmod>
        <changefreq>$changefreq</changefreq>
        <priority>$priority</priority>
    </url>

XML;
    }
}

