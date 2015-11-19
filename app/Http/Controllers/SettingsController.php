<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Helpers\ModuleHelper;
use App\Http\Models\Setting;

class SettingsController extends Controller {
    /*
     * This function renders the home-page of the ERP
     */

    public function showHome() {
        $modules = ModuleHelper::fetchModuleList();
        $users = User::all();
        return view('settings.home', ['modules' => $modules, 'users' => $users]);
    }

    /*
     * This function enables the module via WEB GUI
     * 
     * @param {String} $package - The package / UUID of the app/module 
     * 
     * @return {Redirect} a 4XX http request to redirect to a page
     */

    public function enableModule($package) {
        //find if the module is already enabled
        if (ModuleHelper::isModuleEnabled($package)) {
            //nothing to do, redirect
            return redirect('/settings');
        } else {
            //Enable the module, so create a new module
            ModuleHelper::enableModule($package);
            //After enable, redirect
            return redirect('/settings');
        }
    }

    /*
     * This function disables the module via WEB GUI
     * 
     * @param {String} $package - The package / UUID of the app/module 
     * 
     * @return {Redirect} a 4XX http request to redirect to a page
     */

    public function disableModule($package) {
        //find if the module is already enabled
        if (ModuleHelper::isModuleEnabled($package)) {
            //Proceed to disable the module
            ModuleHelper::disableModule($package);
            return redirect('/settings');
        } else {
            //nothing to do, redirect
            return redirect('/settings');
        }
    }

    /*
     * This method saves (or creates) the company basic settings
     * 
     * @param {Request} $request - The request data
     * 
     * @return {Redirect} Reditect to the settings page
     */

    public function updateGeneral(Request $request) {
        $data = $request->all();
        //Iterate all the settings sended to this form
        foreach ($data['general'] as $key => $value) {
            //Create / update setting
            SettingsController::updateOrCreateSetting($key, $value);
        }
        //Redirect to the settings page
        return redirect('/settings');
    }

    /*
     * This static function creates or update an existing etting in the
     * settings (key => value) table
     * 
     * @param {String} $key - The settings key
     * @param {String} $value - The settings value
     * 
     * @return {Boolean} The operation result (True or false)
     */

    public static function updateOrCreateSetting($key, $value) {
        //Exists?
        $setting = Setting::where('setting_key', '=', $key)->first();
        //Exitsts?
        if ($setting) {
            //Exists, so update
            $setting->setting_value = $value;
        } else {
            //Doens't exist, so create
            $setting = new Setting();
            $setting->setting_key = $key;
            $setting->setting_value = $value;
        }
        return $setting->save();
    }

    /*
     * Fetch's a setting if exists, if not, returns an empty value
     * 
     * @param {String} $key - The setting key
     * 
     * @return {String} The value
     */

    public static function fetchSetting($key) {
        $setting = Setting::where('setting_key', '=', $key)->first();
        if ($setting) {
            return $setting->setting_value;
        } else {
            return '';
        }
    }

    /*
     * Creates / enables a new user in the database
     * 
     * @param {Request} $request - The request data
     * 
     * @return {Redirect} Reditect to the settings page
     */

    public function createUser(Request $request) {
        $data = $request->all();
        $user = new User();
        //Set attributtes
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = \Illuminate\Support\Facades\Hash::make($data['password']);
        //Create and return
        $user->save();
        return redirect('/settings');
    }

    /*
     * Deletes the user using their id, and later redirect's to the settings page
     * 
     * @param {Integer} $id - The user's id
     */

    public function deleteUser($id) {
        $user = User::find($id);
        $user->delete();
        return redirect('/settings');
    }

}

?>