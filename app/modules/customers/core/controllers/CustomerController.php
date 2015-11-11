<?php

namespace App\modules\customers\core\controllers;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\modules\customers\core\models\Customers;

class CustomerController extends Controller {
    /*
     * Renders a list with the clients
     */

    public function actionList() {
        view()->addLocation(app_path() . '/modules/customers/core/views');
        return view('list');
    }

    public function actionNew() {
        view()->addLocation(app_path() . '/modules/customers/core/views');
        return view('new');
    }

}
