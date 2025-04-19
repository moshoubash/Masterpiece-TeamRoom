<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\User;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.notifications.index', [
            'notifications' => Notification::paginate(10),
            'users' => User::all()
        ]);
    }
    
    /**
     * Store a newly created resource in storage.
     */
    
    public function store(Request $request)
    {
        Notification::create($request->all());

        return back()->with('alert', 'Notification sent successfully');
    }

    // mark as read
    public function markAsRead(Request $request){
        $notification = Notification::find($request->id);
        $notification->is_read = true;
        $notification->save();

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $notification = Notification::find($id);
        $notification->delete();

        return back();
    }
}
