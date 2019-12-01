<?php

use Rentit\App;

ini_set('display_errors', 'On');

//autoload
require __DIR__ . '/vendor/autoload.php';

define('ROOT', __DIR__ . '/');
define('TEMPLATES', __DIR__ . '/templates/');

App::run();