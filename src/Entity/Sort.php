<?php

namespace App\Entity;

use App\Repository\SortRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SortRepository::class)
 */
class Sort
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
     * @ORM\OneToMany(targetEntity=CoutStatistique::class, mappedBy="sort")
     */
    private $coutStatistiques;

    /**
     * @ORM\OneToMany(targetEntity=CoutObjet::class, mappedBy="sort")
     */
    private $coutObjets;

    public function __construct()
    {
        $this->coutStatistiques = new ArrayCollection();
        $this->coutObjets = new ArrayCollection();
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

    /**
     * @return Collection<int, CoutStatistique>
     */
    public function getCoutStatistiques(): Collection
    {
        return $this->coutStatistiques;
    }

    public function addCoutStatistique(CoutStatistique $coutStatistique): self
    {
        if (!$this->coutStatistiques->contains($coutStatistique)) {
            $this->coutStatistiques[] = $coutStatistique;
            $coutStatistique->setSort($this);
        }

        return $this;
    }

    public function removeCoutStatistique(CoutStatistique $coutStatistique): self
    {
        if ($this->coutStatistiques->removeElement($coutStatistique)) {
            // set the owning side to null (unless already changed)
            if ($coutStatistique->getSort() === $this) {
                $coutStatistique->setSort(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, CoutObjet>
     */
    public function getCoutObjets(): Collection
    {
        return $this->coutObjets;
    }

    public function addCoutObjet(CoutObjet $coutObjet): self
    {
        if (!$this->coutObjets->contains($coutObjet)) {
            $this->coutObjets[] = $coutObjet;
            $coutObjet->setSort($this);
        }

        return $this;
    }

    public function removeCoutObjet(CoutObjet $coutObjet): self
    {
        if ($this->coutObjets->removeElement($coutObjet)) {
            // set the owning side to null (unless already changed)
            if ($coutObjet->getSort() === $this) {
                $coutObjet->setSort(null);
            }
        }

        return $this;
    }
}
