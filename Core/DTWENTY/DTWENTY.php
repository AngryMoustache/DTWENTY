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
    *   Initializing
    *
    */
    public function __construct()
    {
        $this->Plugins = new stdClass();
        $this->load(
            array(
                'Configure',
                'Route',
                'Database',
                'DTWENTY' => 'D20Exception',
                'Debug',
                'Controller',
                'Model',
                'View',
                'Helper',
                'Plugin',
            )
        );

        Database::connect();
    }

    /*
    *
    *   Initialize DTWENTY
    *
    */
    public function init()
    {
        // Find the current route and render it
        $route = Route::find('/');
        if ($route)
        {
            $this->controllerAction(
                $route['route'],
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
    *   Load Plugins
    *
    */
    public function plugins($plugins)
    {
        foreach ($plugins as $value)
        {
            $path = 'Plugins/' . $value . '/index.php';
            require_once $path;
            $this->Plugins->{$value} = new $value();
        }
    }

    /*
    *
    *   Activate a controllers action
    *
    */
    public function controllerAction($route, $parameters)
    {
        include_once('Controllers/AppController.php');

        if (isset($route['plugin']))
            $plugin = 'Plugins/' . $route['plugin'] . '/';
        else $plugin = '';

        include_once($plugin . 'Controllers/' . $route['controller'] . '.php');
        $this->Controller = new $route['controller']();

        call_user_func_array(array($this->Controller, $route['action']), $parameters);
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
