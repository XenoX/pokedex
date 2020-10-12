<?php

use App\Router;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

require '../vendor/autoload.php';

$loader = new FilesystemLoader('../templates');
$twig = new Environment($loader, [
    'debug' => true,
]);

echo (new Router($twig))->run();
