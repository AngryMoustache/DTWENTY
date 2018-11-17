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
                $path = 'Models/' . $model . '.php';
                if (isset($this->plugin))
                {
                    $path = 'Plugins/' . $this->plugin . '/Models/' . $model . '.php';
                }

                if (is_file($path)) include_once($path);
                else include_once('Models/' . $model . '.php');

                $this->{$model} = new $model();
            }
        }

        // load helpers
        if (count($this->helpers))
        {
            foreach ($this->helpers as $helper)
            {
                $path = 'Views/Helpers/' . $helper . '.php';

                if (is_file($path)) include_once($path);
                else include_once('Core/Helper/Helpers/' . $helper . '.php');

                $this->View->{$helper} = new $helper();
            }
        }
    }

    /*
    *
    *   Redirect to a different page
    *
    */
    public function redirect($target)
    {
        header('Location: ' . $target);
        die();
    }
}
