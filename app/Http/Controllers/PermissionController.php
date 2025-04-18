<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $permission = new Permission();
        $permission->name = $request->input('name');
        $permission->save();

        return view('dashboard.roles.index', [
            'roles' => Role::all(),
            'permissions' => Permission::all()
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $permission = Permission::findOrFail($id);
        $permission->delete();

        return view('dashboard.roles.index', [
            'roles' => Role::all(),
            'permissions' => Permission::all()
        ]);
    }
}
