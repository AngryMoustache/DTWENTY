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
                if (strpos($model, '.') > -1)
                {
                    // Plugin model
                    $model = explode('.', $model);
                    include_once('Plugins/' . $model[0] . '/Models/' . $model[1] . '.php');
                    $model = $model[1];
                }
                else
                {
                    // Core model
                    include_once('Models/' . $model . '.php');
                }

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
