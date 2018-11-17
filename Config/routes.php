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

Route::add(
    array(
        'path' => '/users/:id/delete',
        'controller' => 'UserController',
        'action' => 'delete'
    )
);

Route::add(
    array(
        'path' => '/tags',
        'controller' => 'TagController',
        'action' => 'overview'
    )
);
