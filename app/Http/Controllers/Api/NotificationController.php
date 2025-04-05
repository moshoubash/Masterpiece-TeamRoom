<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return Notification::where('user_id', Auth::user()->id);
        return Notification::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $notification = new Notification();
        
        $notification->user_id = $request->input('user_id');
        $notification->title = $request->input('title');
        $notification->message = $request->input('message');
        $notification->notification_type = $request->input('notification_type');
        $notification->is_read = false;
        $notification->created_at = now();

        $notification->save();

        return response()->json([
            'notification' => $notification,
        ], 201);
    }
}
