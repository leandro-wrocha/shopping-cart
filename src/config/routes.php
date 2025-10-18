<?php

use Core\Routes;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;

Routes::add('GET', '/', [HomeController::class, 'index']);

Routes::add('GET', '/products', [ProductController::class, 'index']);
