<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

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
            return view('pages.users.bookings.details', compact('booking'));
        }

        return view('pages.404');
    }
}