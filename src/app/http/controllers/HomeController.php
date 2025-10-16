<?php

namespace App\Http\Controllers;

use Core\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $this->data['title'] = 'Home';

        $this->render('index');
    }
}
