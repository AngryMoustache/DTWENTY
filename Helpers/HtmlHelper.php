<?php

class Html extends Helper
{
    /*
    *
    *   Return a <link> tag
    *
    */
    public function style($name)
    {
          return '<link rel="stylesheet" type="text/css" href="/Assets/Styles/' . $name . '.css">';
    }
}
