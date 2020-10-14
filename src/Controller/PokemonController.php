<?php

namespace App\Controller;

use App\DAO\PokemonManager;
use Twig\Environment;

class PokemonController extends Controller
{
    private PokemonManager $pokemonManager;

    public function __construct(Environment $twig)
    {
        $this->pokemonManager = new PokemonManager();
        parent::__construct($twig);
    }

    public function index()
    {
        $pokemons = $this->pokemonManager->findAll();

        return $this->render('Pokemon/index.html.twig', ['pokemons' => $pokemons]);
    }
}
