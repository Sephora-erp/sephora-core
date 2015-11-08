<?php

namespace App\Http\Helpers;

use stdClass;
use App\Http\Models\Modules;
use App\Http\Models\Menus;

class ModuleHelper {
    /*
     * This function returns an array with the module list
     */

    public static function fetchModuleList() {
        $modules = [];
        //Make a scandir of the modules dir
        $moduleFolders = scandir(app_path() . '/../modules/');
        //for each module find their manifest and read it
        foreach ($moduleFolders as $moduleFolder) {
            if (file_exists(app_path() . '/../modules/' . $moduleFolder . '/Manifest.php')) {
                include(app_path() . '/../modules/' . $moduleFolder . '/Manifest.php');
                //Create a object from the manifest file
                $tmpObj = new $moduleFolder;
                //Store the module object into the array
                $modules[] = $tmpObj->basic;
            }
        }
        return $modules;
    }

    /*
     * Checks if the package of the module is already enabled or not
     */

    public static function isModuleEnabled($package) {
        $module = Modules::where('package', '=', $package)->first();
        //Check if the query has returned something
        if ($module != null)
            return true;
        else
            return false;
    }

    /*
     * This function enables the module, creating in the modules table a entry 
     * with the registered data of the module
     * 
     * @param {String} $package - The package / UUID of the app/module
     */

    public static function enableModule($package) {
        //Make a scandir of the modules dir
        $moduleFolders = scandir(app_path() . '/../modules/');
        foreach ($moduleFolders as $moduleFolder) {
            if (file_exists(app_path() . '/../modules/' . $moduleFolder . '/Manifest.php')) {
                include(app_path() . '/../modules/' . $moduleFolder . '/Manifest.php');
                //Create a object from the manifest file
                $tmpObj = new $moduleFolder;
                //If we found the package, enable it
                if ($tmpObj->basic['package'] == $package) {
                    //Create a entry in db to store the package
                    $moduleToEnable = new Modules;
                    $moduleToEnable->package = $tmpObj->basic['package'];
                    $moduleToEnable->has_triggers = $tmpObj->basic['has_triggers'];
                    $moduleToEnable->has_hooks = $tmpObj->basic['has_hooks'];
                    //Run the migrations
                    ModuleHelper::runMigrations($moduleFolder);
                    //Create the menus
                    ModuleHelper::setMenus($tmpObj->menus);
                    //Save it
                    $moduleToEnable->save();
                }
            }
        }
    }

    /*
     * This function disables the module
     * 
     * @param {String} $package - The package / UUID of the app/module 
     */

    public static function disableModule($package) {
        $module = Modules::where('package', '=', $package)->first();
        $module->delete();
    }

    /*
     * Run's the migrations for the specified module (path)
     * 
     * @param {String} $path - The path of the migrations (Module's folder name)
     */

    public static function runMigrations($path) {
        //execute the migrations
        exec('php ' . app_path() . '/../' . 'artisan migrate --path=/modules/' . $path . '/migrations/');
    }

    /*
     * Creates the menus entries in the menus table to use it later with the GUI
     * 
     * @param {Mixed[]} $menus - The menus in array way
     */

    public static function setMenus($menus) {
        //Itera over all the menus and create entries
        foreach ($menus as $menu) {
            $newMenu = new Menus();
            //Set basic properties
            if (isset($menu['type']))
                $newMenu->type = $menu['type'];
            if (isset($menu['title']))
                $newMenu->title = $menu['title'];
            if (isset($menu['uuid']))
                $newMenu->uuid = $menu['uuid'];
            if (isset($menu['icon']))
                $newMenu->icon = $menu['icon'];
            if (isset($menu['url']))
                $newMenu->url = $menu['url'];
            if (isset($menu['parent']))
                $newMenu->parent = $menu['parent'];
            if (isset($menu['package']))
                $newMenu->package = $menu['package'];
            //Create the menu entry
            $newMenu->save();
        }
    }

}
