<?php

use Core\Routes;

use App\Http\Controllers\HomeController;

Routes::add('GET', '/', [HomeController::class, 'index']);
