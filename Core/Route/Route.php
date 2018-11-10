<?php

/*
*
*   Route class for writing and reading routes
*
*/
class Route
{
    /*
    *
    *   Variable where the routes goes
    *
    */
    protected static $_instances = array();

    /*
    *
    *   Add a route
    *
    */
    static function add($options)
    {
        $_new = array();

        foreach ($options as $key => $value)
        {
            $_new[$key] = $value;
        }

        self::$_instances[] = $_new;
    }

    /*
    *
    *   Get all routes
    *
    */
    static function get()
    {
        return self::$_instances;
    }

    /*
    *
    *   Find the current route
    *
    */
    static function find($url)
    {
        $foundroute = null;
        $parameters = array();

        // The current URL
        $currenturl = explode('/', $_SERVER['REQUEST_URI']);
        array_shift($currenturl);

        // Loop and find the correct route
        foreach (self::$_instances as $route)
        {
            $_route = explode('/', $route['path']);
            array_shift($_route);

            // Check if they are completely the same
            // This is faster for routes without a parameter
            if ($_route === $currenturl)
            {
                $foundroute = array('route' => $route, 'parameters' => $parameters);
                break;
            }

            foreach ($_route as $checkUrl)
            {
                foreach ($currenturl as $curUrl)
                {
                    // Check if there is a variable
                    $parameter = ((strpos($checkUrl, ':') > -1) ? true : false);
                    if ($checkUrl != $curUrl && !$parameter) break;
                    if ($parameter) {
                        $parameters[ltrim($checkUrl, ':')] = $curUrl;
                    }

                    $foundroute = array('route' => $route, 'parameters' => $parameters);
                }
            }
        }

        return $foundroute;
    }
}
