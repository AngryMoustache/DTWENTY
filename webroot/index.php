<?php

    // Load the core file
    include_once('Core/D20/D20.php');

    // Load the good stuff
    D20::load('Configure');
    D20::load('Database');

    // Connect to the database
    Database::connect();
