<?php

class HomeController extends AppController
{
    public $models = array('User');

    public function home()
    {
        $this->View->set(array('randomNumber' => rand(1, 20)));
        $this->View->render('Home/home');
    }
}
