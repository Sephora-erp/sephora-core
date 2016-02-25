<?php

namespace App\Http\Helpers;

use App\Http\Models\Hooks;

class HookHelper {
    /*
     * This function call's the Hooks for the modules
     * 
     * @param {String} $container - The action name to fire
     * @param {Object} $object - The data to pass to the hook
     */

    public static function fireHook($container, $object) {
        //Find the hooks for this action
        $hooks = Hooks::where('container', '=', $container)->get();
        //Iterate over the hooks to fire the action
        foreach($hooks as $hook){
            //Instantiate the hooks class of the module
            if(file_exists(app_path() . '/modules/' . $hook->folder . '/hooks/listener.php')){
                //If exists, import the file
                require_once(app_path() . '/modules/' . $hook->folder . '/hooks/listener.php');
                //Prepare classname
                $className = $hook->folder.'Hook';
                //Instantiate the new object
                $tmpTrigger = new $className;
                //Call to the action firer
                $tmpTrigger->fireEvent($container, $object);
            }     
        }
    }

}
