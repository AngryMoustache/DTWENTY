<?php

class HomeController extends Controller
{
    public $models = array('User');

    public function home()
    {
        $data = $this->User->find();

        $this->View->set(array(
            'data' => $data,
            'randomNumber' => rand(1, 20)
        ));
        $this->View->render('Home/home');
    }
}
