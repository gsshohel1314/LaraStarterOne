<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

    public function securityIndex(){
        return view('backend.profile.security');
    }

    public function securityUpdate(Request $request){
        $this->validate($request, [
            'current_password' => 'required',
            'password' => 'required|confirmed'
        ]);

        $user = Auth::user();
        $hashedPassword = $user->password;

        if(Hash::check($request->current_password, $hashedPassword)){
            if(!Hash::check($request->password, $hashedPassword)){
                $user->update([
                    'password' => Hash::make($request->password),
                ]);
                Auth::logout();
                return redirect()->route('login');
            }else{
                notify()->warning("New password can not be same as old password","Warning");
            }
        }else{
            notify()->error("Current password did not match","Error");
        }

        return back();
    }
}
