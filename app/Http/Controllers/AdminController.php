<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    public function index(){
        $admins = User::whereHas('roles', function($query) {
            $query->whereIn('name', ['admin', 'superadmin']);
        })->paginate(10);
        
        return view("dashboard.admins.index", [
            'admins' => $admins
        ]);
    }

    public function changeRole(Request $request){
        $user = User::find($request->user_id);
        $role = Role::where('name', $request->role)->first();

        if($request->role == "admin"){
            if($user->roles->first()->name == 'admin'){
                return back()->with('message', 'User is already an admin');
            }
            $user->roles()->sync($role->id);
        }else{
            if($user->roles->first()->name == 'superadmin'){
                return back()->with('message', 'User is already a superadmin');
            }
            $user->roles()->sync($role->id);
        }

        return redirect()->back();
    }
}
