<?php

class customers {
    //Basic activation data
    public $basic = [
        'name' => 'Customers',
        'description' => 'Clients module for CRM function',
        'version' => '0.0.1',
        'vendor' => 'Inforfenix',
        'package' => 'sephora.basic.customers',
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
            'title' => 'Customers',
            'uuid' => 'customers_top',
            'icon' => 'fa fa-users',
            'url' => '/',
            'package' => 'sephora.basic.customers'
        ],
        1 => [
            'type' => 'child',
            'title' => 'New Customer',
            'uuid' => 'customer_new-customer',
            'url' => '/customers/new',
            'parent' => 'customers_top',
            'package' => 'sephora.basic.customers'
        ],
        2 => [
            'type' => 'child',
            'title' => 'List',
            'uuid' => 'customer_list-customers',
            'url' => '/customers/',
            'parent' => 'customers_top',
            'package' => 'sephora.basic.customers'
        ]
    ];
    //Routes data
    public $routes = [
        0 => [
            'type' => 'GET',
            'url' => '/customers/new',
            'action' => '\App\modules\customers\core\controllers\CustomerController@actionNew'
        ],
        1 => [
            'type' => 'GET',
            'url' => '/customers/',
            'action' => '\App\modules\customers\core\controllers\CustomerController@actionList'
        ]
    ];
   /* //Triggers
    public $triggers = [
        0 => [
            'action' => 'pageLoad'
        ]
    ];
    //Hooks declaration
    public $hooks = [
        0 => [
            'container' => 'footer',
        ]
    ];*/
}
