<?php

namespace App\Entity;

use App\Repository\CommentaireRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommentaireRepository::class)]
class Commentaire
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $contenue = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\ManyToOne(inversedBy: 'commentaires')]
    private ?user $user = null;

    /**
     * @var Collection<int, objet>
     */
    #[ORM\OneToMany(targetEntity: objet::class, mappedBy: 'commentaire')]
    private Collection $objet;

    #[ORM\ManyToOne(inversedBy: 'commentaires')]
    private ?objet $Objets = null;

    public function __construct()
    {
        $this->objet = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContenue(): ?string
    {
        return $this->contenue;
    }

    public function setContenue(string $contenue): static
    {
        $this->contenue = $contenue;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getUser(): ?user
    {
        return $this->user;
    }

    public function setUser(?user $user): static
    {
        $this->user = $user;

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
            $objet->setCommentaire($this);
        }

        return $this;
    }

    public function removeObjet(objet $objet): static
    {
        if ($this->objet->removeElement($objet)) {
            // set the owning side to null (unless already changed)
            if ($objet->getCommentaire() === $this) {
                $objet->setCommentaire(null);
            }
        }

        return $this;
    }

    public function getObjets(): ?objet
    {
        return $this->Objets;
    }

    public function setObjets(?objet $Objets): static
    {
        $this->Objets = $Objets;

        return $this;
    }
}
