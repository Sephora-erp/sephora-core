<?php

namespace App\Http\Helpers;

use App\Http\Models\Routes;
use App\Http\Models\RoutesUnsafe;

class RouteHelper {
    /*
     * This function returns an array with the routes availables in db
     */
    public static function fetchRoutes() {
        return Routes::all();
    }
    /*
     * This function returns an array with the routes availables in db
     */
    public static function fetchUnsafeRoutes() {
        return RoutesUnsafe::all();
    }

}
