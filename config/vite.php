<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Vite Build Path
    |--------------------------------------------------------------------------
    |
    | This option defines the path to the Vite build directory. This should
    | be the relative or absolute path where your Vite build output
    | (including the manifest.json file) is stored.
    |
    */

    'build_path' => env('VITE_BUILD_PATH', public_path('build')),

    /*
    |--------------------------------------------------------------------------
    | Development Server URL
    |--------------------------------------------------------------------------
    |
    | During local development, Vite serves assets from its dev server. You
    | can specify the URL for the development server here. This is used
    | when `APP_ENV` is set to `local`.
    |
    */

    'dev_server_url' => env('VITE_DEV_SERVER_URL', 'http://localhost:5173'),

];
