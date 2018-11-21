<?php

/*
*
*   Route file for all the routes
*   Example:
*
*   Route::add(
*       array(
*           'path' => '/',
*           'controller' => 'HomeController',
*           'action' => 'home',
*       )
*   );
*/

Route::add(
    array(
        'path' => '/',
        'controller' => 'HomeController',
        'action' => 'home'
    )
);

Route::add(
    array(
        'path' => '/uploads',
        'controller' => 'UploadController',
        'action' => 'overview',
    )
);

Route::add(
    array(
        'path' => '/uploads/:id',
        'controller' => 'UploadController',
        'action' => 'single'
    )
);

Route::add(
    array(
        'path' => '/page/:id',
        'controller' => 'PageController',
        'action' => 'single'
    )
);
