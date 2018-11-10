<?php

Configure::write('env', 'dev');
include_once Configure::read('env') . '/bootstrap.php';

Configure::write('site.name', 'DTWENTY');
