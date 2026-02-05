<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with(['user', 'vehicle'])->paginate(15);
        return view('admin.bookings.index', ['bookings' => $bookings]);
    }

    public function show(Booking $booking)
    {
        $booking->load(['user', 'vehicle']);
        return view('admin.bookings.show', ['booking' => $booking]);
    }

    public function confirm(Booking $booking)
    {
        $booking->update(['status' => 'confirmed']);
        return redirect()->route('admin.bookings.show', $booking->id)
            ->with('success', 'Pemesanan berhasil dikonfirmasi');
    }

    public function cancel(Booking $booking)
    {
        $booking->update(['status' => 'cancelled']);
        return redirect()->route('admin.bookings.show', $booking->id)
            ->with('success', 'Pemesanan berhasil dibatalkan');
    }
}
