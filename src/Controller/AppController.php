<?php

namespace App\Controller;

class AppController extends Controller
{
    public function index(): string
    {
        return $this->render('index.html.twig');
    }

    public function contact(): string
    {
        return $this->render('contact.html.twig');
    }
}
