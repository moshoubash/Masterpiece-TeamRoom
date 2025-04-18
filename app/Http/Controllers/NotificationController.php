<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.notifications.index', [
            'notifications' => Notification::all()
        ]);
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Notification::create($request->all());

        return view('dashboard.notifications.index');
    }

    // mark as read
    public function markAsRead(Request $request){
        $notification = Notification::find($request->id);
        $notification->is_read = true;
        $notification->save();

        return view('dashboard.notifications.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $notification = Notification::find($id);
        $notification->delete();

        return view('dashboard.notifications.index');
    }
}
