<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::with(['booking.user', 'booking.vehicle'])->paginate(15);
        return view('admin.payments.index', ['payments' => $payments]);
    }

    public function show(Payment $payment)
    {
        $payment->load(['booking.user', 'booking.vehicle']);
        return view('admin.payments.show', ['payment' => $payment]);
    }

    public function confirm(Payment $payment)
    {
        $payment->update(['status' => 'completed']);
        return redirect()->route('admin.payments.show', $payment->id)
            ->with('success', 'Pembayaran berhasil dikonfirmasi');
    }
}
