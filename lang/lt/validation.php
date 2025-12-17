<?php

return [

    'required' => ':attribute yra privalomas.',
    'email' => ':attribute turi būti galiojantis el. pašto adresas.',
    'string' => 'Laukas :attribute turi būti tekstas.',
    'min' => [
        'string' => 'Laukas :attribute turi būti bent :min simbolių.',
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    */
    'attributes' => [
        'email' => 'el. paštas',
        'password' => 'slaptažodis',
    ],
    'title' => 'titulinis'

];
