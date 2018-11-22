<?php

class PageController extends AppController
{
    public $models = array('MenuItem', 'Page');

    public function single($id)
    {
        $page = $this->Page->find(
            array(
                'limit' => 1,
                'where' => array(
                    array('id', '=', $id),
                ),
            )
        );

        $this->View->set(array(
            'page' => $page,
            'menu' => $this->_getMenu('home')
        ));

        $this->View->render('Page/view');
    }
}
