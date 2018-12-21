<?php

Admin::useModel('Menu');
Admin::useModel('MenuItem');
Admin::useModel('Page');
Admin::useModel('User');
Admin::useModel('Upload');
Admin::useModel('Tag');

Admin::navigation(array(
    'Website' => array(
        'User',
        'Page',
    ),
    'Menus' => array(
        'Menu',
        'MenuItem',
    ),
    'Uploads' => array(
        'Media',
        'Upload',
        'Tag',
    )
));
