<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $activities = Activity::paginate(10);
        return view('dashboard.activities.index', compact('activities'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Activity::create($request->all());

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $activity = Activity::find($id);
        $activity->delete();

        return back()->with('success', 'Activity deleted successfully.');
    }

    public function filter($type){
        $activities = Activity::where('type', $type)->paginate(10);
        return view('dashboard.activities.index', compact('activities'));
    }
}
