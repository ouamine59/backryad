<?php

namespace App\Entity;

use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Post;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\OrdersRepository;
use ApiPlatform\Metadata\ApiResource;
use App\Controller\ProductsController;

#[ORM\Entity(repositoryClass: OrdersRepository::class)]
#[ApiResource(
    normalizationContext:['groups' => ['product:read']],
    denormalizationContext:['groups' => ['product:write']],
    operations:[
        new Get(
            paginationEnabled:true,
            uriTemplate: '/orders/by-user/{idclient}',
            name:'api_orders_index_by_user',
            read:false,
        ),
    ]
)
]
class Orders
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $isCreatedAt = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $client = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?States $states = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIsCreatedAt(): ?\DateTimeImmutable
    {
        return $this->isCreatedAt;
    }

    public function setIsCreatedAt(\DateTimeImmutable $isCreatedAt): static
    {
        $this->isCreatedAt = $isCreatedAt;

        return $this;
    }

    public function getClient(): ?User
    {
        return $this->client;
    }

    public function setClient(?User $client): static
    {
        $this->client = $client;

        return $this;
    }

    public function getStates(): ?States
    {
        return $this->states;
    }

    public function setStates(?States $states): static
    {
        $this->states = $states;

        return $this;
    }
}
