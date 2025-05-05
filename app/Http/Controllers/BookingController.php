<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Transaction;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookings = Booking::paginate(10);
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

    public function edit(int $id){
        $booking = Booking::find($id);
        return view('dashboard.booking.edit', compact('booking'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $booking = Booking::find($id);
        $booking->update($request->all());

        return redirect()->back();  
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

    public function store(Request $request){
        $start_time = $request->start_time;
        $end_time = $request->end_time;
        $date = $request->date;

        $start_datetime = date('Y-m-d H:i:s', strtotime("$date $start_time"));
        $end_datetime = date('Y-m-d H:i:s', strtotime("$date $end_time"));

        $request->merge([
            'start_datetime' => $start_datetime,
            'end_datetime' => $end_datetime,
        ]);

        Booking::create([
            'space_id' => $request->space_id,
            'renter_id' => Auth::user()->id,
            'start_datetime' => $start_datetime,
            'end_datetime' => $end_datetime,
            'num_attendees' => $request->num_attendees,
            'total_price' => $request->total_price,
            'service_fee' => $request->service_fee,
            'host_payout' => $request->host_payout
        ]);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function info(string $id) {
        $booking = Booking::find($id);

        // check authentication
        if(!Auth::check()){
            return redirect()->route('login');
        }

        if($booking->renter_id == Auth::user()->id){
            $currentTime = \Carbon\Carbon::parse(date('Y-m-d H:i:s', strtotime('+3 hours')));
            $hoursSinceBookingCreated = \Carbon\Carbon::parse($booking->created_at)->diffInHours($currentTime, true);
            $canRefund = $hoursSinceBookingCreated <= 24 && \Carbon\Carbon::parse($booking->start_datetime)->isFuture();
            
            return view('pages.users.bookings.details', compact('booking', 'canRefund'));
        }

        return view('pages.404');
    }

    public function filter($status) {
        $bookings = Booking::where('status', $status)->paginate(10);
        
        return view('dashboard.booking.index', compact('bookings'));
    }

    public function approve($id) {
        $booking = Booking::find($id);
        $booking->status = 'confirmed';
        $booking->save();

        Notification::create([
            'user_id' => $booking->renter_id,
            'title' => 'Your booking has been confirmed',
            'notification_type' => 'Booking',
            'message' => 'Your booking has been confirmed on ' . $booking->start_datetime
        ]);

        return redirect()->back();
    }

    public function reject($id) {
        $booking = Booking::find($id);
        $booking->status = 'cancelled';
        $booking->save();

        Notification::create([
            'user_id' => $booking->renter_id,
            'title' => 'Your booking has been rejected',
            'notification_type' => 'Booking',
            'message' => 'Your booking has been rejected on ' . $booking->start_datetime
        ]);

        return redirect()->back();
    }
}