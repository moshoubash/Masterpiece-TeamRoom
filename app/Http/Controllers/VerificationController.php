<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class VerificationController extends Controller
{
    public function requests()
    {
        $hosts = User::whereHas('roles', function ($query) {
            $query->where('name', 'host');
        })
        ->whereDoesntHave('roles', function ($query) {
            $query->whereIn('name', ['admin', 'superadmin']);
        })
        ->where('id_document_path', '!=', null)
        ->where('kyc_status', 'pending')->get();

        return view('dashboard.kyc.requests', compact('hosts'));
    }

    public function approve(User $user)
    {
        $user->kyc_status = 'approved';
        $user->save();

        Notification::create([
            'user_id' => $user->id,
            'title' => 'KYC Approved',
            'notification_type' => 'kyc',
            'message' => 'Your KYC has been approved.',
        ]);

        return back()->with('success', 'User KYC Approved.');
    }

    public function reject(User $user)
    {
        $user->kyc_status = 'rejected';
        $user->save();

        Notification::create([
            'user_id' => $user->id,
            'title' => 'KYC Rejected',
            'notification_type' => 'kyc',
           'message' => 'Your KYC has been rejected.',
        ]);

        return back()->with('success', 'User KYC Rejected.');
    }

    public function verification(){
        if(Auth::user()->kyc_status == 'approved'){
            return back()->with('message', 'You already have approved KYC.');
        }

        return view('pages.users.verification');
    }

    public function submit(Request $request)
    {
        $request->validate([
            'id_document' => 'required|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $user = Auth::user();

        $path = $request->file('id_document')->store('id_documents', 'public');

        $user->id_document_path = $path;
        $user->kyc_status = 'pending';
        
        $user->save();

        $admins = User::whereHas('roles', function ($query) {
            $query->whereIn('name', ['admin', 'superadmin']);
        })->get();

        foreach ($admins as $admin) {
            Notification::create([
                'user_id' => $admin->id,
                'title' => 'New KYC Request',
                'notification_type' => 'kyc',
                'message' => 'New KYC request from ' . $user->email,
            ]);
        }

        return redirect()->route('home')->with('message', 'Document submitted! Within 24 hours, your KYC will be approved.');
    }
}
