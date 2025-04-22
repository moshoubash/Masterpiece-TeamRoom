<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Space;

class SpaceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.spaces.index', ['spaces' => Space::paginate(10)]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $space = Space::findOrFail($id);
        return view('dashboard.spaces.show', ['space' => $space]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $space = Space::findOrFail($id);
        return view('dashboard.spaces.edit', ['space' => $space]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $space = Space::findOrFail($id);
        $space->update($request->all());

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $space = Space::findOrFail($id);
        $space->is_deleted = true;
        $space->save();

        return back();
    }

    public function explore() {
        return view('pages.explore', ['rooms' => Space::paginate(10)]);
    }

    public function roomDetails(string $slug) {
        $space = Space::where('slug', $slug)->first();
        return view('pages.spaces.details', ['space' => $space]);
    }

    public function create(){
        $currentStep = 1;
        $completionPercentage = 25;
        return view('pages.spaces.create', [
            'currentStep' => $currentStep,
            'completionPercentage' => $completionPercentage
        ]);
    }
}
