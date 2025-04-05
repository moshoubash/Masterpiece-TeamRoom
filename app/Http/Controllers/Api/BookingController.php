<?php

namespace App\Http\Controllers\Api;

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
        return Booking::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $booking = Booking::find($id);
        if ($booking) {
            return response()->json($booking, 200);
        }
        return response()->json(['message' => 'Booking not found'], 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        dd($request->all());
        $booking = \App\Models\Booking::find($id);
        if (!$booking) {
            return response()->json(['message' => 'Booking not found'], 404);
        }
        $booking->update($request->all());
        return response()->json($booking, 200);  
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $booking = Booking::find($id);
        if ($booking) {
            $booking->delete();
            return response()->json(['message' => 'Booking deleted successfully'], 200);
        }
        return response()->json(['message' => 'Booking not found'], 404);
    }
}
