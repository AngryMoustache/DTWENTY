<?php

class Controller
{
    /*
    *
    *   The models this controller uses
    *
    */
    public $models;

    /*
    *
    *   Initialize the controller
    *
    */
    public function __construct()
    {
        $this->View = new View();
    }
}
