<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Contact\ContactSendRequest;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Devrabiul\ToastMagic\Facades\ToastMagic;

class ContactController extends Controller
{
    public function send(ContactSendRequest $request)
    {
        try {
            $validated = $request->validated();

            $currentDate = Carbon::now()->toFormattedDateString();

            Mail::to('mohammedshobash2002@gmail.com')->send(new \App\Mail\ContactMail($validated, $currentDate));

            ToastMagic::success('Your message has been sent successfully!');

            return back();
        } catch (\Exception $e) {
            ToastMagic::error('Failed to send message. Please try again.');
            return back();
        }
    }
}
