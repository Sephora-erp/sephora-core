<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use App\Http\Helpers\ModuleHelper;

class SettingsController extends Controller {

    /*
     * This function renders the home-page of the ERP
     */
    public function showHome() {
        $modules = ModuleHelper::fetchModuleList();
        return view('settings.home', ['modules' => $modules]);
    }

    /*
     * This function enables the module via WEB GUI
     * 
     * @param {String} $package - The package / UUID of the app/module 
     * 
     * @return {Redirect} a 4XX http request to redirect to a page
     */
    public function enableModule($package){
        //find if the module is already enabled
        if(ModuleHelper::isModuleEnabled($package)){
            //nothing to do, redirect
            return redirect('/settings');
        }else{
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
    public function disableModule($package){
        //find if the module is already enabled
        if(ModuleHelper::isModuleEnabled($package)){
            //Proceed to disable the module
            ModuleHelper::disableModule($package);
            return redirect('/settings');
        }else{
            //nothing to do, redirect
            return redirect('/settings');
        }
    }
}

?>