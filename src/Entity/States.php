<?php

namespace App\Entity;

use App\Repository\StatesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StatesRepository::class)]
class States
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 30)]
    private ?string $states = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStates(): ?string
    {
        return $this->states;
    }

    public function setStates(string $states): static
    {
        $this->states = $states;

        return $this;
    }
}
