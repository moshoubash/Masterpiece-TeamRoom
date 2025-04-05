<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = \App\Models\Role::with('permissions')->get();
        return $roles; 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $role = new Role();
        $role->name = $request->input('name');
        $role->save();

        return response()->json([
            'role' => $role,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $role = \App\Models\Role::find($id);
        if (!$role) {
            return response()->json(['message' => 'Role not found'], 404);
        }
        return $role;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $role = Role::findOrFail($id);
        $role->name = $request->input('name');
        $role->save();

        if ($request->has('permissions')) {
            $role->permissions()->sync($request->input('permissions'));
        }

        return response()->json([
            'role' => $role->load('permissions'),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role = \App\Models\Role::find($id);
        if (!$role) {
            return response()->json(['message' => 'Role not found'], 404);
        }
        $role->delete();
        return response()->json(['message' => 'Role deleted successfully']);
    }
}
