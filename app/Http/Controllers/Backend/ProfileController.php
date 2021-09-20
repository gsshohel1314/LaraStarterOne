<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function profileIndex()
    {
        return view('backend.profile.profile');
    }

    public function profileUpdate(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
            'image' => 'nullable|image'
        ]);

        // Get logged in user
        $user = Auth::user();

        // Update user info
        $user->update([
            'name' => $request->name,
            'email' => $request->email
        ]);

        // Upload image
        if($request->hasFile('image')){
            $user->addMedia($request->image)->toMediaCollection('image');
        }

        notify()->success("Profile Updated","Success");
        return back();
    }
}
