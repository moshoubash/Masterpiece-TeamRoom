<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SpaceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return \App\Models\Space::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $space = \App\Models\Space::find($id);
        if (!$space) {
            return response()->json(['message' => 'Space not found'], 404);
        }
        return response()->json($space, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $space = \App\Models\Space::find($id);
        if (!$space) {
            return response()->json(['message' => 'Space not found'], 404);
        }
        $space->update($request->all());
        return response()->json($space, 200);        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $space = \App\Models\Space::find($id);
        $space->is_deleted = true;
        $space->save();
        return response()->json(['message' => 'Space deleted successfully'], 200);
    }
}
