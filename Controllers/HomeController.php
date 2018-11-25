<?php

class HomeController extends AppController
{
    public $models = array('MenuItem', 'Upload');

    public function home()
    {
        $recent = $this->Upload->find(
            array(
                'orderBy' => 'RAND()',
                'limit' => 5,
                'where' => array(
                    array('private', '=', '0'),
                ),
            )
        );

        $this->View->set(array(
            'recent' => $recent,
            'menu' => $this->_getMenu('home')
        ));

        $this->View->render('Home/home');
    }
}
