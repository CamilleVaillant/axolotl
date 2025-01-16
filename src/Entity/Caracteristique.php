<?php

namespace App\Entity;

use App\Repository\CaracteristiqueRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CaracteristiqueRepository::class)]
class Caracteristique
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    /**
     * @var Collection<int, objet>
     */
    #[ORM\ManyToMany(targetEntity: objet::class, inversedBy: 'caracteristiques')]
    private Collection $objet;

    public function __construct()
    {
        $this->objet = new ArrayCollection();
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

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, objet>
     */
    public function getObjet(): Collection
    {
        return $this->objet;
    }

    public function addObjet(objet $objet): static
    {
        if (!$this->objet->contains($objet)) {
            $this->objet->add($objet);
        }

        return $this;
    }

    public function removeObjet(objet $objet): static
    {
        $this->objet->removeElement($objet);

        return $this;
    }
}
