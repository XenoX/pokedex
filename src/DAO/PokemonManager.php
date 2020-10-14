<?php

namespace App\DAO;

use App\Model\Pokemon;

class PokemonManager extends DAO
{
    public function findAll(): array
    {
        $result = $this->createQuery('SELECT * FROM pokemon');

        $pokemons = [];
        foreach ($result->fetchAll() as $pokemon) {
            try {
                $types = json_decode($pokemon->types, true, 512, JSON_THROW_ON_ERROR);
            } catch (\JsonException $e) {
                $types = [];
            }

            try {
                $seenAt = new \DateTimeImmutable($pokemon->seen_at);
            } catch (\Exception $e) {
                $seenAt = new \DateTimeImmutable();
            }

            $pokemons[] = (new Pokemon())
                ->setName($pokemon->name)
                ->setTypes($types)
                ->setNumber($pokemon->number)
                ->setImage($pokemon->image)
                ->setIsCaptured($pokemon->is_captured)
                ->setSeenAt($seenAt)
            ;
        }

        return $pokemons;
    }

    public function create(Pokemon $pokemon): bool
    {
        $sql = 'INSERT INTO pokemon (name, number, types, image, is_captured, seen_at) VALUES (?, ?, ?, ?, ?, ?)';

        try {
            $types = json_encode($pokemon->getTypes(), JSON_THROW_ON_ERROR);
        } catch (\JsonException $e) {
            $types = '';
        }

        $this->createQuery(
            $sql,
            [
                $pokemon->getName(),
                $pokemon->getNumber(),
                $types,
                $pokemon->getImage(),
                $pokemon->isCaptured() ? 1 : 0,
                $pokemon->getSeenAt()->format('Y-m-d H:i:s')
            ]
        );

        return true;
    }
}
