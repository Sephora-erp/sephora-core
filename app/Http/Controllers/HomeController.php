<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;

class HomeController extends Controller {

    /*
     * This function renders the home-page of the ERP
     */
    public function showHome() {
        return view('home.home');
    }

}

?>