<?php

namespace App\Http\Helpers;

use App\Http\Models\Routes;

class RouteHelper {
    /*
     * This function returns an array with the routes availables in db
     */
    public static function fetchRoutes() {
        return Routes::all();
    }

}
