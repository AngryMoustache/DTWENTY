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
        'path' => '/users',
        'controller' => 'UserController',
        'action' => 'overview'
    )
);

Route::add(
    array(
        'path' => '/users/create',
        'controller' => 'UserController',
        'action' => 'create'
    )
);

Route::add(
    array(
        'path' => '/users/:id',
        'controller' => 'UserController',
        'action' => 'single'
    )
);
