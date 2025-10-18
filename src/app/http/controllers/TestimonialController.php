<?php

namespace App\Http\Controllers;

use Core\Controller;

class TestimonialController extends Controller
{
    public function index()
    {
        $this->data['title'] = 'Testimonials - Famms';

        return $this->render('testimonial', $this->data);
    }
}
