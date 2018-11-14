<?php

class TagController extends AppController
{
    public $models = array('Tag');

    public function overview()
    {
        $data = $this->Tag->find(array(
            'select' => array(
                'tags.id',
                'tags.name',
                'users.username',
                'tags.user_id',
            )
        ));

        $this->View->set(array('data' => $data));
        $this->View->render('Tag/overview');
    }
}
