<?php

class Html extends Helper
{
    /*
    *
    *   Return a <link> tag
    *
    */
    public function style($name, $plugin = null)
    {
        $link = '/Assets/Styles/' . $name . '.css';
        if ($plugin != null) $link = '/Plugins/' . $plugin . $link;

        return '<link rel="stylesheet" type="text/css" href="' . $link . '">';
    }

    /*
    *
    *   Return a URL for a route
    *
    */
    public function link($shorthand, $parameters = array())
    {
        $routes = Route::get();
        $path = array_search($shorthand, array_column($routes, 'shorthand'));

        if ($path !== false)
        {
            $route = $routes[$path];
            $_route = $route['path'];

            foreach ($parameters as $key => $value)
            {
                $_route = str_replace(':' . $key, $value, $_route);
            }

            return $_route;
        }
        else
        {
            throw new D20Exception('Route not found');
        }

    }
}
