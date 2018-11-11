<?php

    // Load the core file
    include_once('Core/DTWENTY/DTWENTY.php');

    $D20 = new DTWENTY();

    // Load the plugins
    $D20->plugins(
        array(
            'Admin'
        )
    );

    // Start DTWENTY
    $D20->init();
