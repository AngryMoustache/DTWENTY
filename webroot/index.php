<?php

    // Config laden

    // Database connecting

    // Load stuff
    include_once('../Core/Configure/Configure.php');

    // $config = new Configure();
    // $config->write('test', array('test', 'test'));
    // var_dump($config->read('test'));

    Configure::write('test', array('test'));
    Configure::read('test');
