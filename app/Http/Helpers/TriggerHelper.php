<?php

namespace App\Http\Helpers;

use App\Http\Models\Triggers;

class TriggerHelper {
    /*
     * This function call's the triggers for the modules
     * 
     * @param {String} $action - The action name to fire
     * @param {Object} $object - The data to pass to the trigger
     */

    public static function fireTrigger($action, $object) {
        //Find the triggers for this action
        $triggers = Triggers::where('action', '=', $action)->get();
        //Iterate over the triggers to fire the action
        foreach($triggers as $trigger){
            //Instantiate the trigger class of the module
            if(file_exists(app_path() . '/modules/' . $trigger->folder . '/triggers/listener.php')){
                //If exists, import the file
                require(app_path() . '/modules/' . $trigger->folder . '/triggers/listener.php');
                //Prepare classname
                $className = $trigger->folder.'Trigger';
                //Instantiate the new object
                $tmpTrigger = new $className;
                //Call to the action firer
                $tmpTrigger->fireEvent($action, $object);
            }     
        }
    }

}
