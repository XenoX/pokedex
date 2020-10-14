<?php

namespace App;

use App\Controller\AppController;
use App\Controller\PokemonController;
use Twig\Environment;

class Router
{
    private Environment $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    public function run(): string
    {
        $appController = new AppController($this->twig);
        $pokemonController = new PokemonController($this->twig);

        if (isset($_GET['route'])) {
            if ('contact' === $_GET['route']) {
                return $appController->contact();
            }

            if ('pokemons' === $_GET['route']) {
                return $pokemonController->index();
            }
        }

        return $appController->index();
    }
}
