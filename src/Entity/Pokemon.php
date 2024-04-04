<?php

namespace App\Entity;

use App\Repository\PokemonRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PokemonRepository::class)]
class Pokemon
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    private ?string $image = null;

    #[ORM\Column]
    private ?int $code = null;

    #[ORM\ManyToMany(targetEntity: Debilidad::class, inversedBy: 'pokemon')]
    private Collection $debilidades;

    public function __construct()
    {
        $this->debilidades = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getCode(): ?int
    {
        return $this->code;
    }

    public function setCode(int $code): static
    {
        $this->code = $code;

        return $this;
    }

    /**
     * @return Collection<int, Debilidad>
     */
    public function getDebilidades(): Collection
    {
        return $this->debilidades;
    }

    public function addDebilidade(Debilidad $debilidade): static
    {
        if (!$this->debilidades->contains($debilidade)) {
            $this->debilidades->add($debilidade);
        }

        return $this;
    }

    public function removeDebilidade(Debilidad $debilidade): static
    {
        $this->debilidades->removeElement($debilidade);

        return $this;
    }
}
