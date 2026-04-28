<?php

namespace App\Http\Controllers;
use App\Services\CreateNewActivity;
use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Http\Requests\Booking\StoreBookingRequest;
use App\Http\Requests\Booking\UpdateBookingRequest;
use App\Services\BookingService;
class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookings = Booking::latest()->paginate(10);
        return view('dashboard.booking.index', compact('bookings'));
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $booking = Booking::find($id);
        return view('dashboard.booking.show', compact('booking'));
    }

    public function edit(int $id)
    {
        $booking = Booking::findOrFail($id);
        $renters = \App\Models\User::role('renter')->get();

        return view('dashboard.booking.edit', compact('booking', 'renters'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookingRequest $request, string $id)
    {
        $booking = Booking::find($id);
        $booking->update($request->validated());

        return redirect()->back()->with('success', 'Booking updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $booking = Booking::find($id);

        if ($booking->transactions()->exists()) {
            return back()->with('message', 'This booking has transactions and cannot be deleted.');
        }

        $booking->delete();

        return back();
    }

    public function store(StoreBookingRequest $request, BookingService $bookingService)
    {
        $bookingService->createBooking($request->validated());

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $id
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function info(string $id)
    {
        $booking = Booking::find($id);

        // check authentication
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if ($booking->renter_id == Auth::user()->id) {
            return view('pages.users.bookings.details', [
                'booking' => $booking,
                'canRefund' => $booking->can_refund
            ]);
        }

        return view('pages.404');
    }

    public function filter($status)
    {
        $bookings = Booking::where('status', $status)->latest()->paginate(10);

        return view('dashboard.booking.index', compact('bookings'));
    }

    public function approve($id, BookingService $bookingService)
    {
        $booking = Booking::findOrFail($id);

        if (Auth::id() != $booking->space->host_id && !Auth::user()->hasRole('admin') && !Auth::user()->hasRole('superadmin')) {
            return back()->with('error', 'Unauthorized action.');
        }

        $bookingService->updateBookingStatus(
            $booking,
            'confirmed',
            'Your booking has been confirmed',
            'Your booking has been confirmed'
        );

        return redirect()->back();
    }

    public function reject($id, BookingService $bookingService)
    {
        $booking = Booking::findOrFail($id);

        if (Auth::id() != $booking->space->host_id && !Auth::user()->hasRole('admin') && !Auth::user()->hasRole('superadmin')) {
            return back()->with('error', 'Unauthorized action.');
        }

        $bookingService->updateBookingStatus(
            $booking,
            'cancelled',
            'Your booking has been rejected',
            'Your booking has been rejected'
        );

        return redirect()->back();
    }

    public function complete($id, BookingService $bookingService)
    {
        $booking = Booking::findOrFail($id);

        if (Auth::id() != $booking->space->host_id && !Auth::user()->hasRole('admin') && !Auth::user()->hasRole('superadmin')) {
            return back()->with('error', 'Unauthorized action.');
        }

        $bookingService->updateBookingStatus($booking, 'completed', '', '');
        return back()->with('success', 'Booking completed successfully');
    }
}