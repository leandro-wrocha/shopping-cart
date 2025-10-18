<?php

namespace App\Http\Controllers;

use Core\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $this->data['title'] = 'Famms - Fashion';

        $this->render('index', $this->data);
    }
}
