<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index(){
        $wishlist = Wishlist::where('user_id', auth()->user()->id)->get();
        return view('pages.users.wishlist', compact('wishlist'));
    }

    public function add($id){
        $wishlist = Wishlist::where('user_id', auth()->user()->id)->where('space_id', $id)->first();
        
        if($wishlist){
            return back()->with('error','Space already in wishlist');
        }

        $wishlist = new Wishlist;
        $wishlist->user_id = Auth::user()->id;
        $wishlist->space_id = $id;
        $wishlist->save();
        return back()->with('success','Space added to wishlist');
    }

    public function remove($id){
        $wishlist = Wishlist::where('user_id', auth()->user()->id)->where('space_id', $id)->firstOrFail();
        $wishlist->delete();
        return back()->with('success','Space removed from wishlist');
    }
}
