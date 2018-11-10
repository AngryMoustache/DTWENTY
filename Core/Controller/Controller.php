<?php

class Controller
{
    /*
    *
    *   The models this controller uses
    *
    */
    public $models = array();

    /*
    *
    *   Initialize the controller
    *
    */
    public function __construct()
    {
        $this->View = new View();

        // load models
        if (count($this->models))
        {
            foreach ($this->models as $model)
            {
                include_once('Models/' . $model . '.php');
                $this->{$model} = new $model();
            }
        }
    }
}
