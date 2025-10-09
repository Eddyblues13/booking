<?php
// [file name]: AdminBookingController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class AdminBookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with(['user', 'flight', 'passengers'])
            ->latest()
            ->paginate(10);

        return view('admin.bookings.index', compact('bookings'));
    }

    public function show(Booking $booking)
    {
        $booking->load(['user', 'flight', 'passengers']);
        return view('admin.bookings.show', compact('booking'));
    }

    public function updateStatus(Request $request, Booking $booking)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,cancelled',
            'payment_status' => 'required|in:pending,paid,failed,refunded'
        ]);

        $booking->update($request->only(['status', 'payment_status']));

        return back()->with('success', 'Booking status updated successfully.');
    }

    public function destroy(Booking $booking)
    {
        $booking->passengers()->delete();
        $booking->delete();

        return redirect()->route('admin.bookings.index')
            ->with('success', 'Booking deleted successfully.');
    }
}
