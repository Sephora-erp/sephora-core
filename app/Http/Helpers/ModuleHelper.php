<?php

namespace App\Http\Helpers;

use stdClass;

class ModuleHelper {
    /*
     * This function returns an array with the module list
     */

    public static function fetchModuleList() {
        $modules = [];
        //Make a scandir of the modules dir
        $moduleFolders = scandir(app_path().'/../modules/');
        //for each module find their manifest and read it
        foreach($moduleFolders as $moduleFolder){
            if(file_exists(app_path().'/../modules/'.$moduleFolder.'/Manifest.php')){
                include(app_path().'/../modules/'.$moduleFolder.'/Manifest.php');
                //Create a object from the manifest file
                $tmpObj = new $moduleFolder;
                $modules[] = $tmpObj->basic;
            }
        }
        return $modules;
    }

}
