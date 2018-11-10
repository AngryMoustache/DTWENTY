<?php

/*
*
*   Core class for DTWENTY, called D20 for easier use
*
*/
class DTWENTY
{
    /*
    *
    *   Initialize DTWENTY
    *
    */
    public function init()
    {
        Database::connect();

        // Find the current route and render it
        $route = Route::find('/');
        if ($route)
        {
            $this->controllerAction(
                $route['route']['controller'],
                $route['route']['action'],
                $route['parameters']
            );
        }
        else
        {
            throw new D20Exception('Route not found');
        }
    }

    /*
    *
    *   Load a Core file
    *
    */
    public function load($files)
    {
        foreach ($files as $key => $value)
        {
            if (gettype($key) == 'integer')
                $path = 'Core/' . $value . '/' . $value . '.php';
            else
                $path = 'Core/' . $key . '/' . $value . '.php';

            require_once $path;
        }
    }

    /*
    *
    *   Activate a controllers action
    *
    */
    public function controllerAction($controller, $action, $parameters)
    {
        include_once('Controllers/AppController.php');
        include_once('Controllers/' . $controller . '.php');
        $this->Controller = new $controller();
        call_user_func_array(array($this->Controller, $action), $parameters);
    }

    /*
    *
    *   Throw error message
    *
    */
    static function throwError($message = 'Something went from with DTWENTY', $code = 500)
    {
        throw new D20Exception($message);
    }
}
