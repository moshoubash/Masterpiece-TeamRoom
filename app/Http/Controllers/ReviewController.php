<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;
use App\Models\Notification;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reviews = Review::paginate(10);
        return view('dashboard.reviews.index', compact('reviews'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $review = Review::find($id);
        $review->delete();

        return back();
    }

    public function filter($review){
        $reviews = Review::where('rating', 'like', '%'.$review.'%')->paginate(10);

        return view('dashboard.reviews.index', compact('reviews'));
    }

    public function store(Request $request, $id){
        $booking = Booking::find($id);
        
        if($booking == null){
            return view('pages.404');
        }

        $review = Review::create([
            'reviewer_id' => $booking->space->host_id,
            'reviewee_id' => $booking->renter->id,
            'booking_id' => $id,
            'space_id' => $booking->space_id,
            'rating' => $request->rating,
            'review_text' => $request->review_text ?? ''
        ]);

        $notification = Notification::create([
            'user_id' => $booking->space->host_id,
            'notification_type' => 'Review',
            'title' => 'New Review',
            'message' => 'You have a new review from ' . $booking->renter->name
        ]);

        return back()->with('alert', 'Review submitted successfully');
    }    
}