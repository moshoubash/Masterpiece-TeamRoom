<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $currentDate = Carbon::now()->toFormattedDateString();

        Mail::send('Pages.Mail.template', ['data' => $validated, 'date' => $currentDate], function ($message) use ($validated) {
            $message->to('mohammedshobash2002@gmail.com')
                    ->subject($validated['subject'])
                    ->replyTo($validated['email']);
        });

        return back()->with('success', 'Your message has been sent successfully!');
    }
}
