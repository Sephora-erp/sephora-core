<?php

namespace App\Http\Helpers;

use stdClass;
use App\Http\Models\Modules;
use App\Http\Models\Menus;
use App\Http\Models\Routes;
use App\Http\Models\Triggers;
use App\Http\Models\Hooks;

class ModuleHelper {
    /*
     * This function returns an array with the module list
     */

    public static function fetchModuleList() {
        $modules = [];
        //Make a scandir of the modules dir
        $moduleFolders = scandir(app_path() . '/modules/');
        //for each module find their manifest and read it
        foreach ($moduleFolders as $moduleFolder) {
            if (file_exists(app_path() . '/modules/' . $moduleFolder . '/Manifest.php')) {
                include(app_path() . '/modules/' . $moduleFolder . '/Manifest.php');
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
        $moduleFolders = scandir(app_path() . '/modules/');
        foreach ($moduleFolders as $moduleFolder) {
            if (file_exists(app_path() . '/modules/' . $moduleFolder . '/Manifest.php')) {
                include(app_path() . '/modules/' . $moduleFolder . '/Manifest.php');
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
                    //Activate the routes
                    ModuleHelper::setRoutes($tmpObj->routes);
                    //Register the triggers
                    ModuleHelper::enableTriggers($tmpObj->basic['package'], $moduleFolder, $tmpObj->triggers);
                    //Register the hooks
                    ModuleHelper::enableHooks($tmpObj->basic['package'], $moduleFolder, $tmpObj->hooks);
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
        //Disables the menus
        ModuleHelper::unSetMenus($package);
        //Disables the triggers
        ModuleHelper::disableTriggers($package);
        //Disables the triggers
        ModuleHelper::disableHooks($package);
        //Delete
        $module->delete();
    }

    /*
     * Run's the migrations for the specified module (path)
     * 
     * @param {String} $path - The path of the migrations (Module's folder name)
     */

    public static function runMigrations($path) {
        //execute the migrations
        exec('php ' . app_path() . '/../' . 'artisan migrate --path=/app/modules/' . $path . '/migrations/');
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

    /*
     * Erases the menu entries after desactivating the module
     * 
     * @param {String} $package - The package name
     */

    public static function unSetMenus($package) {
        $menusToDelete = Menus::where('package', '=', $package)->get();
        foreach ($menusToDelete as $menu) {
            $menu->delete();
        }
    }

    /*
     * This function set's the routes of the module
     * 
     * @param {Mixed[]} $routes - The routes array with the available routes
     * for the module
     * 
     */

    public static function setRoutes($routes) {
        foreach ($routes as $route) {
            $tmpRoute = new Routes();
            //Set attributes
            $tmpRoute->type = $route['type'];
            $tmpRoute->url = $route['url'];
            $tmpRoute->action = $route['action'];
            //Save the route
            $tmpRoute->save();
        }
    }

    /*
     * Enables the triggers for the module, this registers the
     * trigger in the triggers table
     * 
     * @param {String} $package - The package / UUID string
     * @param {String} $folder - The folder of the module
     * @param {$mixed[]} $triggers - An array with all the triggers
     */

    public static function enableTriggers($package, $folder, $triggers) {
        foreach ($triggers as $trigger) {
            $tmpTrigger = new Triggers();
            //Set properties
            $tmpTrigger->folder = $folder;
            $tmpTrigger->package = $package;
            $tmpTrigger->action = $trigger['action'];
            //Store the trigger
            $tmpTrigger->save();
        }
    }

    /*
     * Erases the triggers for the triggers table
     * 
     * @param {String} $package - The package / UUID
     */

    public static function disableTriggers($package) {
        $triggers = Triggers::where('package', '=', $package)->get();
        foreach ($triggers as $trigger) {
            $trigger->delete();
        }
    }

    /*
     * Enables the hooks for the module, this registers the
     * hook in the hooks table
     * 
     * @param {String} $package - The package / UUID string
     * @param {String} $folder - The folder of the module
     * @param {$mixed[]} $hooks - An array with all the hooks
     */

    public static function enableHooks($package, $folder, $hooks) {
        foreach ($hooks as $hook) {
            $tmpHook = new Hooks();
            //Set properties
            $tmpHook->folder = $folder;
            $tmpHook->package = $package;
            $tmpHook->container = $hook['container'];
            //Store the trigger
            $tmpHook->save();
        }
    }

    /*
     * Erases the hooks for the hooks table
     * 
     * @param {String} $package - The package / UUID
     */

    public static function disableHooks($package) {
        $hooks = Hooks::where('package', '=', $package)->get();
        foreach ($hooks as $hook) {
            $hook->delete();
        }
    }

}
