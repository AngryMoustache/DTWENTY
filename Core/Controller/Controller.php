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
    *   The helpers this controller uses
    *
    */
    public $helpers = array();

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

        // load helpers
        if (count($this->helpers))
        {
            foreach ($this->helpers as $helper)
            {
                include_once('Helpers/' . $helper . 'Helper.php');
                $this->View->{$helper} = new $helper();
            }
        }
    }
}
