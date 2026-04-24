<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Devrabiul\ToastMagic\Facades\ToastMagic;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlist = Wishlist::where('user_id', auth()->user()->id)->get();
        return view('pages.users.wishlist', compact('wishlist'));
    }

    public function add($id)
    {
        $wishlist = Wishlist::where('user_id', auth()->user()->id)->where('space_id', $id)->first();

        if ($wishlist) {
            ToastMagic::error('Space already in wishlist');
            return back();
        }

        $wishlist = new Wishlist;
        $wishlist->user_id = Auth::user()->id;
        $wishlist->space_id = $id;
        $wishlist->save();
        ToastMagic::success('Space added to wishlist');
        return back();
    }

    public function remove($id)
    {
        $wishlist = Wishlist::where('user_id', auth()->user()->id)->where('space_id', $id)->firstOrFail();
        $wishlist->delete();
        return back()->with('success', 'Space removed from wishlist');
    }
}
