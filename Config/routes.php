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
Route::add('/', 'HomeController', 'home');
Route::add('/users', 'UserController', 'overview');
Route::add('/users/:id', 'UserController', 'single');
