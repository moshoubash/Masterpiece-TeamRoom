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

        $spaces = Space::all();
        return view('dashboard.spaces.index', ['spaces' => $spaces]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $space = Space::findOrFail($id);
        $space->delete();

        return view('dashboard.spaces.index', ['spaces' => Space::all()]);
    }
}
