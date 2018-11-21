<?php

class UserAdmin extends AdminModel
{
    public $overviewFields = array(
        'id',
        'avatar',
        'username',
        'email',
        'admin',
    );

    public $imageFields = array(
        'avatar',
    );
}
