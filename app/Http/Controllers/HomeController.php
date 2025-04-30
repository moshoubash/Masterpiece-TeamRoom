<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Space;

class HomeController extends Controller
{
    public function index()
    {
        $meetingRooms = Space::all()->take(5);
        return view('welcome', compact('meetingRooms'));
    }
}
