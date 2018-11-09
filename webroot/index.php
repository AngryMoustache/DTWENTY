<?php

    // Config laden

    // Database connecting

    // Test: Configure class
    include_once('Core/Configure/Configure.php');

    Configure::write('site.name', 'DTWENTY');
    echo Configure::read('site.name');
