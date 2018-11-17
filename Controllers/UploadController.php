<?php

class UploadController extends AppController
{
    public $models = array('Upload');

    public function overview()
    {
        $uploads = $this->Upload->find(
            array(
                'where' => array(
                    array('deleted_at', '=', null),
                    array('private', '=', '0'),
                ),
            )
        );

        $this->View->set(array('uploads' => $uploads));
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

        $this->View->set(array('upload' => $upload));
        $this->View->render('Upload/single');
    }
}
