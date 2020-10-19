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
            $pokemons[] = $this->buildObject($pokemon);
        }

        return $pokemons;
    }

    public function findOneBy(string $attribute, $value): ?Pokemon
    {
        $result = $this->createQuery("SELECT * FROM pokemon WHERE {$attribute} = ?", [$value]);

        if (false === $object = $result->fetchObject()) {
            return null;
        }

        return $this->buildObject($object);
    }

    public function findBy(string $attribute, $value): array
    {
        $result = $this->createQuery("SELECT * FROM pokemon WHERE {$attribute} = ?", [$value]);

        $pokemons = [];
        foreach ($result->fetchAll() as $pokemon) {
            $pokemons[] = $this->buildObject($pokemon);
        }

        return $pokemons;
    }

    public function update(Pokemon $pokemon): bool
    {
        $result = $this->createQuery(
            'UPDATE pokemon SET name = ?, number = ?, types = ?, image = ?, is_captured = ?, seen_at = ? WHERE id = ?',
            array_merge($this->buildValues($pokemon), [$pokemon->getId()])
        );

        return 1 <= $result->rowCount();
    }

    public function create(Pokemon $pokemon): int
    {
        return $this->createQuery(
            'INSERT INTO pokemon (name, number, types, image, is_captured, seen_at) VALUES (?, ?, ?, ?, ?, ?)',
            $this->buildValues($pokemon)
        );
    }

    public function delete(Pokemon $pokemon): bool
    {
        $result = $this->createQuery('DELETE FROM pokemon WHERE id = ?', [$pokemon->getId()]);

        return 1 <= $result->rowCount();
    }

    private function buildValues(Pokemon $pokemon): array
    {
        try {
            $types = json_encode($pokemon->getTypes(), JSON_THROW_ON_ERROR);
        } catch (\JsonException $e) {
            $types = '';
        }

        return [
            $pokemon->getName(),
            $pokemon->getNumber(),
            $types,
            $pokemon->getImage(),
            $pokemon->isCaptured() ? 1 : 0,
            $pokemon->getSeenAt()->format('Y-m-d H:i:s')
        ];
    }

    private function buildObject(object $pokemon): Pokemon
    {
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

        return (new Pokemon())
            ->setId($pokemon->id)
            ->setName($pokemon->name)
            ->setTypes($types)
            ->setNumber($pokemon->number)
            ->setImage($pokemon->image)
            ->setIsCaptured($pokemon->is_captured)
            ->setSeenAt($seenAt)
        ;
    }
}
