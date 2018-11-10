<?php

    // Load the core file
    include_once('Core/DTWENTY/DTWENTY.php');

    $D20 = new DTWENTY();

    // Load the good stuff
    $D20->load(
        array(
            'DTWENTY' => 'D20Exception',
            'Debug',
            'Controller',
            'Model',
            'Route',
            'Configure',
            'Database',
            'View',
            'Helper',
            'Plugin',
        )
    );

    $D20->plugins(
        array(
            'Admin'
        )
    );

    // Start DTWENTY
    $D20->init();
