<?php

class PageAdmin extends AdminModel
{
    public $adminFields = array(
        'body' => array('type' => 'Textarea'),
    );

    public $overviewFields = array(
        'id',
        'title',
    );
}
