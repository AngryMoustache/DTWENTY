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

        if (!isset($_new['shorthand']))
        {
            $_new['shorthand'] = $_new['action'] . '@' . $_new['controller'];
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
        $foundRoute = null;
        $parameters = array();

        // The current URL
        $currentUrl = explode('/', $_SERVER['REQUEST_URI']);
        array_shift($currentUrl);

        // Loop and find the correct route
        foreach (self::$_instances as $_sysRoute)
        {
            $sysRoute = explode('/', $_sysRoute['path']);
            array_shift($sysRoute);

            // Check if the length matches
            if (count($sysRoute) == count($currentUrl))
            {
                $parameters = array();

                for ($i = 0; $i < count($sysRoute); $i++)
                {
                    $parameter = (strpos($sysRoute[$i], ':') > -1);
                    if ($sysRoute[$i] == $currentUrl[$i])
                    {
                        // Nothing, continue
                    }
                    else if ($parameter)
                    {
                        $parameters[ltrim($sysRoute[$i], ':')] = $currentUrl[$i];
                    }
                    else
                    {
                        break;
                    }

                    if ($i + 1 == count($sysRoute))
                    {
                        $foundRoute = array('route' => $_sysRoute, 'parameters' => $parameters);
                        break 2;
                    }
                }
            }
        }

        return $foundRoute;
    }
}
