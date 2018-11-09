<?php

class Configure
{
    /*
    *
    *   Variable where the config goes
    *
    */
    protected static $_instances = array();

    /*
    *
    *   Write configure data
    *
    */
    static function write($name, $data)
    {
        self::$_instances[$name] = $data;
    }

    /*
    *
    *   Read configure data
    *
    */
    static function read($name)
    {
        return self::$_instances[$name];
    }
}
