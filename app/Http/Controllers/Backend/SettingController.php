<?php

namespace App\Http\Controllers\Backend;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    // General settings logic start
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

    // Appearance settings logic start
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

    // Mail settings logic start
    public function mailIndex(){
        return view('backend.setting.mail');
    }

    public function mailUpdate(Request $request){
        $this->validate($request, [
            'mail_mailer' => 'string|max:255',
            'mail_host' => 'nullable|string|max:255',
            'mail_port' => 'nullable|string|max:255',
            'mail_username' => 'nullable|string|max:255',
            'mail_password' => 'nullable|string|max:255',
            'mail_encryption' => 'nullable|string|max:255',
            'mail_from_address' => 'nullable|email|max:255',
            'mail_from_name' => 'nullable|string|max:255',
        ]);

        Setting::updateOrCreate(['key' => 'mail_mailer'], ['value' => $request->get('mail_mailer')]);
        Artisan::call("env:set MAIL_MAILER='".$request->get('mail_mailer')."'");

        Setting::updateOrCreate(['key' => 'mail_host'], ['value' => $request->get('mail_host')]);
        Artisan::call("env:set MAIL_HOST='".$request->get('mail_host')."'");

        Setting::updateOrCreate(['key' => 'mail_port'], ['value' => $request->get('mail_port')]);
        Artisan::call("env:set MAIL_PORT='".$request->get('mail_port')."'");

        Setting::updateOrCreate(['key' => 'mail_username'], ['value' => $request->get('mail_username')]);
        Artisan::call("env:set MAIL_USERNAME='".$request->get('mail_username')."'");

        Setting::updateOrCreate(['key' => 'mail_password'], ['value' => $request->get('mail_password')]);
        Artisan::call("env:set MAIL_PASSWORD='".$request->get('mail_password')."'");

        Setting::updateOrCreate(['key' => 'mail_encryption'], ['value' => $request->get('mail_encryption')]);
        Artisan::call("env:set MAIL_ENCRYPTION='".$request->get('mail_encryption')."'");

        Setting::updateOrCreate(['key' => 'mail_from_address'], ['value' => $request->get('mail_from_address')]);
        Artisan::call("env:set MAIL_FROM_ADDRESS='".$request->get('mail_from_address')."'");

        Setting::updateOrCreate(['key' => 'mail_from_name'], ['value' => $request->get('mail_from_name')]);
        Artisan::call("env:set MAIL_FROM_NAME='".$request->get('mail_from_name')."'");

        notify()->success("Setting Updated","Success");
        return back();
    }
}
