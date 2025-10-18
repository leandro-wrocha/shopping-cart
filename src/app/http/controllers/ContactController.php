<?php

namespace App\Http\Controllers;

use Core\Controller;

class ContactController extends Controller
{
    public function index()
    {
        $this->data['title'] = 'Contact Us - Famms';

        return $this->render('contact', $this->data);
    }
}
