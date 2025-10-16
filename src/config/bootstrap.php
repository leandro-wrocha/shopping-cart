<?php

use Core\Routes;
use Core\Uri;

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/routes.php';

Routes::dispatch($_SERVER['REQUEST_METHOD'], Uri::path());
