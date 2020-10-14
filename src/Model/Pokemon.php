<?php

namespace App\Model;

class Pokemon
{
    private int $id;
    private string $name;
    private string $number;
    private array $types;
    private ?string $image;
    private bool $isCaptured;
    private \DateTimeImmutable $seenAt;

    public function __construct()
    {
        $this->image = null;
        $this->isCaptured = false;
        $this->seenAt = new \DateTimeImmutable();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     *
     * @return Pokemon
     */
    public function setId(int $id): Pokemon
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return Pokemon
     */
    public function setName(string $name): Pokemon
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getNumber(): string
    {
        return $this->number;
    }

    /**
     * @param string $number
     *
     * @return Pokemon
     */
    public function setNumber(string $number): Pokemon
    {
        $this->number = $number;

        return $this;
    }

    /**
     * @return array
     */
    public function getTypes(): array
    {
        return $this->types;
    }

    /**
     * @param array $types
     *
     * @return Pokemon
     */
    public function setTypes(array $types): Pokemon
    {
        $this->types = $types;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getImage(): ?string
    {
        return $this->image;
    }

    /**
     * @param string|null $image
     *
     * @return Pokemon
     */
    public function setImage(?string $image): Pokemon
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return bool
     */
    public function isCaptured(): bool
    {
        return $this->isCaptured;
    }

    /**
     * @param bool $isCaptured
     *
     * @return Pokemon
     */
    public function setIsCaptured(bool $isCaptured): Pokemon
    {
        $this->isCaptured = $isCaptured;

        return $this;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getSeenAt(): \DateTimeImmutable
    {
        return $this->seenAt;
    }

    /**
     * @param \DateTimeImmutable $seenAt
     *
     * @return Pokemon
     */
    public function setSeenAt(\DateTimeImmutable $seenAt): Pokemon
    {
        $this->seenAt = $seenAt;

        return $this;
    }
}
