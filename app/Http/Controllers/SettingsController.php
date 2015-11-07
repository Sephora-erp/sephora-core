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

}

?>