<?php

return [
    'domain'       => 'App\Domain',

    /*
    |--------------------------------------------------------------------------
    | Default application
    |--------------------------------------------------------------------------
    |
    | The default application can set one of the applications defined below.
    |
    */
    'application'  => 'web',

    /*
    |--------------------------------------------------------------------------
    | Application Layer architecture definition
    |--------------------------------------------------------------------------
    |
    | Multiple application layer architecture can be defined here.
    |
    */
    'applications' => [
        'api' => [
            "path"       => 'app\API',
            'controller' => 'App\Http\Controllers\APIController',
        ],
        'web' => [
            "path"       => 'app\Application',
            "controller" => 'App\Http\Controllers\Controller',
        ],
    ],
];
