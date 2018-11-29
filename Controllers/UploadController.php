<?php

class UploadController extends AppController
{
    public $models = array('MenuItem', 'Upload', 'Tag');

    public function overview()
    {
        $uploads = $this->Upload->find(
            array(
                'where' => array(
                    array('private', '=', '0'),
                ),
            )
        );

        if (isset($_GET['tag']))
        {
            for ($i = count($uploads); $i >= 0; $i--)
            {
                if (array_search($_GET['tag'], array_column($uploads[$i]['Tags'], 'id')) === null
                    || array_search($_GET['tag'], array_column($uploads[$i]['Tags'], 'id')) === false)
                {
                    unset($uploads[$i]);
                }
            }
        }

        $tags = $this->Tag->find();

        $this->View->set(array(
            'menu' => $this->_getMenu('home'),
            'uploads' => $uploads,
            'tags' => $tags,
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
