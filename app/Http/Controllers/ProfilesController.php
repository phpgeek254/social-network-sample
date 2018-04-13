<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfilesController extends Controller
{

    public function index($slug)
    {
        $user = User::where('slug', $slug)->first();
        return view('profiles/profile', compact('user'));
    }

    public function edit()
    {
    	$profile  = Auth::user()->profile;
        return view('profiles.edit',  compact('profile'));
    }

    public function update(Request $r)
    {
        $this->validate($r, [
            'location' => 'required',
            'about' => 'required'
        ]);

        if ( $r->hasFile('avatar')){
            Auth::user()->update([
                'avatar' => $r->avatar->store('public/avatars')
            ]);
        }

        Auth::user()->profile()->update([
            'location' => $r->input('location'),
            'about' => $r->input('about')
        ]);
        return redirect( route('profile', ['slug'=>Auth::user()->slug]))->withMessage('Profile Saved');
    }
}
