<?php

class Configure
{
    /*
    *
    *   Variable where the config goes
    *
    */
    public $vars;

    /*
    *
    *   Write configure data
    *
    */
    public function write($name, $data)
    {
        $this->vars[$name] = $data;
    }

    /*
    *
    *   Read configure data
    *
    */
    public function read($name)
    {
        return $this->vars[$name];
    }
}
