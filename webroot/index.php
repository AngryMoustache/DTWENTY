<?php

    // testing purposes
    include_once('Core/Configure/Configure.php');
    include_once('Core/Database/Database.php');

    Database::connect();
    var_dump(Database::test('SELECT * FROM users'));
