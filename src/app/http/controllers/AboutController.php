<?php

namespace App\Http\Controllers;

use Core\Controller;

class AboutController extends Controller
{
    public function index()
    {
        $this->data['title'] = 'About Us - Famms';

        return $this->render('about', $this->data);
    }
}
