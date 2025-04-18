<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Booking;
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
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Booking::create($request->all());
        return view('dashboard.booking.index');
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

        $bookings = Booking::all();
        return view('dashboard.booking.index', compact('bookings'));  
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $booking = Booking::find($id);
        $booking->delete();
        
        $bookings = Booking::all();
        return view('dashboard.booking.index', compact('bookings'));
    }
}
