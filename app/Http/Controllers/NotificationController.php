<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        return view('dashboard.notifications.index', [
            'notifications' => Notification::where('user_id', Auth::user()->id)->paginate(10),
            'users' => User::all()
        ]);
    }
    
    public function store(Request $request)
    {
        Notification::create($request->all());

        return back()->with('alert', 'Notification sent successfully');
    }

    public function filter(Request $request){
        $query = Notification::query();

        // Status filter
        if($request->filled('status')){
            $query->where('is_read', $request->status == 'read' ? true : false);
        }

        // Search Keyword filter
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('user_id', 'like', '%' . $request->search . '%')
                    ->orWhere('notification_type', 'like', '%' . $request->search  . '%');
            });
        }

        // Sort filter
        if ($request->filled('type')) {
            $query->where('notification_type', $request->type);
        }

        $notifications = $query->paginate(10);
        $users = User::all();

        return view('dashboard.notifications.index', [
            'users' => $users,
            'notifications' => $notifications
        ]);
    }
    
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

    public function markAllAsRead(string $id)
    {
        $user = User::findOrFail($id);

        if (!$user) {
            return back();
        }

        $notifications = Notification::where('user_id', $user->id)->get();

        if (!$notifications) {
            return back();
        }

        foreach ($notifications as $notification) {
            $notification->is_read = true;
            $notification->save();
        }

        return back();
    }
}
