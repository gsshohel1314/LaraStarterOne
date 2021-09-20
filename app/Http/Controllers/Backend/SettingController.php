<?php

namespace App\Http\Controllers\Backend;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function generalIndex(){
        return view('backend.setting.general');
    }

    public function generalUpdate(Request $request){
        $this->validate($request, [
            'site_title' => 'required|string|min:2|max:255',
            'site_description' => 'nullable|string|min:2|max:255',
            'site_address' => 'nullable|string|min:2|max:255',
        ]);

        Setting::updateOrCreate(['key'=>'site_title'], ['value'=>$request->get('site_title')]);
        // Update .env APP_NAME
        Artisan::call("env:set APP_NAME='".$request->get('site_title')."'");
        Setting::updateOrCreate(['key'=>'site_description'], ['value'=>$request->get('site_description')]);
        Setting::updateOrCreate(['key'=>'site_address'], ['value'=>$request->get('site_address')]);

        notify()->success("Setting Updated","Success");
        return back();
    }

    public function appearanceIndex(){
        return view('backend.setting.appearance');
    }

    public function appearanceUpdate(Request $request){
        $this->validate($request, [
            'site_logo' => 'nullable|image',
            'site_favicon' => 'nullable|image',
        ]);

        // Update logo
        if($request->hasFile('site_logo')){
            $this->deleteOldLoge(setting('site_logo'));
            Setting::updateOrCreate(
                ['key' => 'site_logo'],
                ['value' => Storage::disk('public')->putFile('logo', $request->file('site_logo'))]
            );
        }

        // Update favicon
        if($request->hasFile('site_favicon')){
            $this->deleteOldLoge(setting('site_favicon'));
            Setting::updateOrCreate(
                ['key' => 'site_favicon'],
                ['value' => Storage::disk('public')->putFile('logo', $request->file('site_favicon'))]
            );
        }

        notify()->success("Setting Updated","Success");
        return back();
    }

    // Delete old image function
    private function deleteOldLoge($path){
        Storage::disk('public')->delete($path);
    }
}
