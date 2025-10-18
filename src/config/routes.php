<?php

use Core\Routes;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\TestimonialController;

Routes::add('GET', '/', [HomeController::class, 'index']);

Routes::add('GET', '/products', [ProductController::class, 'index']);

Routes::add('GET', '/blog', [BlogController::class, 'index']);

Routes::add('GET', '/about', [AboutController::class, 'index']);

Routes::add('GET', '/testimonial', [TestimonialController::class, 'index']);

Routes::add('GET', '/contact', [ContactController::class, 'index']);
