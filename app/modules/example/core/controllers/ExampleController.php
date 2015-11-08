<?php

namespace App\modules\example\core\controllers;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class ExampleController extends Controller {

    public function actionTest() {
        view()->addLocation(app_path().'/modules/example/core/views');
        return view('hello');
        echo 'Hello dolly';
    }

}
