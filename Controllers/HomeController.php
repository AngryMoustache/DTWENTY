<?php

class HomeController extends AppController
{
    public $models = array('Upload');

    public function home()
    {
        $recent = $this->Upload->find(
            array(
                'orderBy' => 'RAND()',
                'limit' => 5,
                'where' => array(
                    array('deleted_at', '=', null),
                    array('private', '=', '0'),
                ),
            )
        );

        $this->View->set(array('recent' => $recent));
        $this->View->render('Home/home');
    }
}
