<?php

class UserController extends AppController
{
    public $models = array('User');

    public function overview()
    {
        $data = $this->User->find();

        $this->View->set(array('data' => $data));
        $this->View->render('User/overview');
    }

    public function single($id)
    {
        $user = $this->User->find('*',
            array(
                'where' => 'id = ' . $id,
                'limit' => 1,
            )
        );

        $this->View->set(array('user' => $user));
        $this->View->render('User/single');
    }

    public function create()
    {
        if (isset($_POST['username']))
        {
            $_user = $this->User->create(array(
                'username' => $_POST['username']
            ));

            $user = $this->User->find('*',
                array(
                    'where' => 'id = ' . $_user,
                    'limit' => 1,
                )
            );

            $this->View->set(array('user' => $user));
            $this->redirect('/users/' . $_user);
        }
        else
        {
            $this->View->render('User/create');
        }
    }
}
