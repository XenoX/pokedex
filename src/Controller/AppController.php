<?php

namespace App\Controller;

use App\DAO\PokemonManager;
use Twig\Environment;

class AppController extends Controller
{
    private PokemonManager $pokemonManager;

    public function __construct(Environment $twig)
    {
        $this->pokemonManager = new PokemonManager();
        parent::__construct($twig);
    }

    public function index(): string
    {
        return $this->render('App/index.html.twig', ['pokemons' => $this->pokemonManager->findBy('is_captured', true)]);
    }

    public function contact(): string
    {
        return $this->render('App/contact.html.twig');
    }
}
