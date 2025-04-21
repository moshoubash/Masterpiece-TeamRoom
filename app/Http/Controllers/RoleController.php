<?php

namespace App\Http\Controllers;

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
        $roles = Role::all();
        return view('dashboard.roles.index', ['roles' => $roles]); 
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

        return view('dashboard.roles.index', ['roles' => Role::all()]);
    }

    public function edit($id){
        $role = Role::findOrFail($id);
        return view('dashboard.roles.edit', ['role' => $role]);
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

        return view('dashboard.roles.index', ['roles' => Role::all()]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role = \App\Models\Role::find($id);
        if($role){
            $role->delete();
        }

        return view('dashboard.roles.index', ['roles' => Role::all()]);
    }
}
