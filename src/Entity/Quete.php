<?php

namespace App\Entity;

use App\Repository\QueteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=QueteRepository::class)
 */
class Quete
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="float")
     */
    private $experience;

    /**
     * @ORM\ManyToMany(targetEntity=Personnage::class)
     */
    private $personnages;

    /**
     * @ORM\ManyToMany(targetEntity=Lieu::class)
     */
    private $lieus;

    /**
     * @ORM\OneToMany(targetEntity=ObjetPossede::class, mappedBy="quete")
     */
    private $objets;

    public function __construct()
    {
        $this->personnages = new ArrayCollection();
        $this->lieus = new ArrayCollection();
        $this->objets = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getExperience(): ?float
    {
        return $this->experience;
    }

    public function setExperience(float $experience): self
    {
        $this->experience = $experience;

        return $this;
    }

    /**
     * @return Collection<int, Personnage>
     */
    public function getPersonnages(): Collection
    {
        return $this->personnages;
    }

    public function addPersonnage(Personnage $personnage): self
    {
        if (!$this->personnages->contains($personnage)) {
            $this->personnages[] = $personnage;
        }

        return $this;
    }

    public function removePersonnage(Personnage $personnage): self
    {
        $this->personnages->removeElement($personnage);

        return $this;
    }

    /**
     * @return Collection<int, Lieu>
     */
    public function getLieus(): Collection
    {
        return $this->lieus;
    }

    public function addLieu(Lieu $lieu): self
    {
        if (!$this->lieus->contains($lieu)) {
            $this->lieus[] = $lieu;
        }

        return $this;
    }

    public function removeLieu(Lieu $lieu): self
    {
        $this->lieus->removeElement($lieu);

        return $this;
    }

    /**
     * @return Collection<int, ObjetPossede>
     */
    public function getObjets(): Collection
    {
        return $this->objets;
    }

    public function addObjet(ObjetPossede $objet): self
    {
        if (!$this->objets->contains($objet)) {
            $this->objets[] = $objet;
            $objet->setQuete($this);
        }

        return $this;
    }

    public function removeObjet(ObjetPossede $objet): self
    {
        if ($this->objets->removeElement($objet)) {
            // set the owning side to null (unless already changed)
            if ($objet->getQuete() === $this) {
                $objet->setQuete(null);
            }
        }

        return $this;
    }
}
