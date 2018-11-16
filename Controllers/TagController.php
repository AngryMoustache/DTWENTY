<?php

class TagController extends AppController
{
    public $models = array('Tag');

    public function overview()
    {
        $data = $this->Tag->find();

        $this->View->set(array('data' => $data));
        $this->View->render('Tag/overview');
    }
}
