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
        $activities = Activity::latest()->paginate(10);

        $activitiesTypes = cache()->remember('activity_types', now()->addDay(), function () {
            return Activity::distinct()->pluck('type')->toArray();
        });

        return view('dashboard.activities.index', compact('activities', 'activitiesTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Activity::create($request->all());
        cache()->forget('activity_types');

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $activity = Activity::findOrFail($id);
        $activity->delete();
        cache()->forget('activity_types');

        return back()->with('success', 'Activity deleted successfully.');
    }

    public function filter($type)
    {
        $activities = Activity::where('type', $type)
            ->latest()
            ->paginate(10);

        $activitiesTypes = cache()->remember('activity_types', now()->addDay(), function () {
            return Activity::distinct()->pluck('type')->toArray();
        });

        return view('dashboard.activities.index', compact('activities', 'activitiesTypes'));
    }
}
