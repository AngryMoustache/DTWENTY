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

        if ($plugin != null)
            $link = '/Plugins/' . $plugin . $link;

        return '<link rel="stylesheet" type="text/css" href="' . $link . '">';
    }
}
