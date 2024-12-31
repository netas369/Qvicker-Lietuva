<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Entry Points
    |--------------------------------------------------------------------------
    |
    | The "entrypoints" array defines the files that should be considered
    | entry points for the Vite build. These files will be included
    | in the application's frontend to bootstrap your JavaScript.
    |
    */

    'entrypoints' => [
        'resources/js/app.js',
        'resources/css/app.css',
    ],

    /*
    |--------------------------------------------------------------------------
    | Development Server
    |--------------------------------------------------------------------------
    |
    | When running the Vite development server, the URL to the server should
    | be set here. If this is set to null, the asset helper will default
    | to building the assets via the "npm run build" command.
    |
    */

    'dev_server' => env('VITE_DEV_SERVER', 'http://localhost:5173'),

    /*
    |--------------------------------------------------------------------------
    | Aliases
    |--------------------------------------------------------------------------
    |
    | You may define aliases to be used in your Vite configuration.
    | These aliases allow you to shorten imports in your JavaScript.
    |
    */

    'aliases' => [
        '@' => resource_path('js'),
    ],

];
