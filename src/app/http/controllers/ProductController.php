<?php

namespace App\Http\Controllers;

use Core\Controller;

class ProductController extends Controller
{
    public function index()
    {
        $this->data['title'] = 'Products';

        $this->render('products');
    }
}
