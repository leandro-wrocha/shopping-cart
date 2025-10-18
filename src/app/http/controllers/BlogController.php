<?php

namespace App\Http\Controllers;

use Core\Controller;

class BlogController extends Controller
{
    public function index()
    {
        $this->data['title'] = 'Blog - Famms';

        return $this->render('blog', $this->data);
    }
}
