<?php

class UploadController extends AppController
{
    public $models = array('MenuItem', 'Upload');

    public function overview()
    {
        $uploads = $this->Upload->find(
            array(
                'where' => array(
                    array('private', '=', '0'),
                ),
            )
        );

        $this->View->set(array(
            'uploads' => $uploads,
            'menu' => $this->_getMenu('home')
        ));

        $this->View->render('Upload/overview');
    }

    public function single($id)
    {
        $upload = $this->Upload->find(
            array(
                'limit' => 1,
                'where' => array(
                    array('id', '=', $id),
                ),
            )
        );

        $this->View->set(array(
            'upload' => $upload,
            'menu' => $this->_getMenu('home')
        ));

        $this->View->render('Upload/single');
    }
}
