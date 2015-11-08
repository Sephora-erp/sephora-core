<?php

class example {
    //Basic activation data
    public $basic = [
        'name' => 'Example module',
        'description' => 'This module give\'s you an example how to build a module',
        'version' => '0.0.1',
        'vendor' => 'Inforfenix',
        'package' => 'sephora.basic.example',
        'min-sephora' => '0.0.1',
        'max-sephora' => '0.0.1',
        'icon' => '',
        'has_triggers' => 0,
        'has_hooks' => 0
    ];
    //Menus array
    public $menus = [
        0 => [
            'type' => 'top',
            'title' => 'Example',
            'uuid' => 'example_top',
            'icon' => 'fa fa-star',
            'url' => '/example',
            'package' => 'sephora.basic.example'
        ],
        1 => [
            'type' => 'child',
            'title' => 'sub-action',
            'uuid' => 'example_sub-action',
            'url' => '/example/child',
            'parent' => 'example_top',
            'package' => 'sephora.basic.example'
        ]
    ];
    //Routes data
    public $routes = [
        0 => [
            'type' => 'GET',
            'url' => '/example/child',
            'action' => '\App\modules\example\core\controllers\ExampleController@actionTest'
        ]
    ];
}
