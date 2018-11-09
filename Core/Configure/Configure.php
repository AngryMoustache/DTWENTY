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
    public function write($name, $data)
    {
        self::$_instances[$name] = $data;
    }

    /*
    *
    *   Read configure data
    *
    */
    public function read($name)
    {
        return self::$_instances[$name];
    }
}
