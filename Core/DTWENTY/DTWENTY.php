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
    *   $this->View for calling the View class
    *
    */
    public function init()
    {
        // Database::connect();
        // $this->View = new View();
        $this->controllerAction('HomeController', 'home');
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
    *   Render a page (main by default)
    *
    */
    public function controllerAction($controller, $action)
    {
        // $this->controller = 'HomeController';
        // $this->View->render($view);

        include_once('Controllers/' . $controller . '.php');
        $this->Controller = new $controller();
        $this->Controller->$action();
    }

    /*
    *
    *   Load the content
    *
    */
    public function content()
    {
        // include_once('Views/' . $view);
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
