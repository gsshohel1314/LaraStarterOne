<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index(){
        return view('backend.profile.index');
    }

    public function update(Request $request){
        $this->validate($request,[
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
            'avatar' => 'nullable|image'
        ]);

        // Get logged in user
        $user = Auth::user();

        // Update user info
        $user->update([
            'name' => $request->name,
            'email' =>$request->email
        ]);

        // Upload image
        if($request->hasFile('avatar')){
            $user->addMedia($request->avatar)->toMediaCollection('avatar');
        }

        notify()->success('Profile Updated','Success');
        return back();
    }

    public function changePassword(){
        return view('backend.profile.password');
    }

    public function updatePassword(Request $request){
        $this->validate($request,[
            'current_password' => 'required',
            'password' => 'required|confirmed',
        ]);

        // Get logged in user
        $user = Auth::user();

        // Get logged in users password
        $hashPassword = $user->password;

        if(Hash::check($request->current_password, $hashPassword)){
            if(!Hash::check($request->password, $hashPassword)){
                $user->update([
                    'password' => Hash::make($request->password)
                ]);
                Auth::logout();
                return redirect()->route('login');
            }else{
                notify()->warning("New password can't be same as old password ", 'Warning');
            }
        }else{
            notify()->error('Current password not match', 'Error');
        }

        return back();
    }
}
