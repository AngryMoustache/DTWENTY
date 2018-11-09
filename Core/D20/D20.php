<?php

/*
*
*   Core class for DTWENTY, called D20 for easier use
*
*/
class D20
{
    /*
    *
    *   Load a Core file
    *
    */
    static function load($filename)
    {
        require_once('Core/' . $filename . '/' . $filename . '.php');
    }


    /*
    *
    *   Var dump with some pre tags
    *
    */
    static function dump($data)
    {
        echo '<pre>';
        var_dump($data);
        echo '</pre>';
    }
}
