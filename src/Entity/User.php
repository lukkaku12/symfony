<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '"user"')]
#[ApiResource(
    operations: [
        new Get(uriTemplate: '/user/{id}'),
        new GetCollection(uriTemplate: '/user'),
        new Post(uriTemplate: '/user'),
        new Put(uriTemplate: '/user/{id}'),
        new Delete(uriTemplate: '/user/{id}'),
    ]
)]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $names = null;

    #[ORM\Column(length: 100)]
    private ?string $lastnames = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $img = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getNames(): ?string
    {
        return $this->names;
    }

    public function setNames(string $names): static
    {
        $this->names = $names;

        return $this;
    }

    public function getLastnames(): ?string
    {
        return $this->lastnames;
    }

    public function setLastnames(string $lastnames): static
    {
        $this->lastnames = $lastnames;

        return $this;
    }

    public function getImg(): ?string
    {
        return $this->img;
    }

    public function setImg(?string $img): static
    {
        $this->img = $img;

        return $this;
    }
}
