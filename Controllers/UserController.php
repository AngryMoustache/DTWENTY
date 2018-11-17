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
                'username' => $_POST['username'],
                'password' => $_POST['password'],
            ));

            if (!isset($_user['errors']))
            {
                $this->redirect('/users/' . $_user);
            }
            else
            {
                $this->View->set(array('errors' => $_user['errors']));
                $this->View->render('User/create');
            }
        }
        else
        {
            $this->View->render('User/create');
        }
    }
}
