<?php

namespace App\Controller;

class AppController extends Controller
{
    public function index(): string
    {
        return $this->render('App/index.html.twig');
    }

    public function contact(): string
    {
        return $this->render('App/contact.html.twig');
    }
}
