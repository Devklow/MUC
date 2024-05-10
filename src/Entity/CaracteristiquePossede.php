<?php

namespace App\Entity;

use App\Repository\CaracteristiquePossedeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CaracteristiquePossedeRepository::class)
 */
class CaracteristiquePossede
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $valeur;

    /**
     * @ORM\ManyToOne(targetEntity=Caracteristique::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $caracteristique;

    /**
     * @ORM\ManyToOne(targetEntity=Personnage::class, inversedBy="caracteristiques")
     */
    private $personnage;

    /**
     * @ORM\ManyToOne(targetEntity=Race::class, inversedBy="caracteristiques")
     */
    private $race;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getValeur(): ?float
    {
        return $this->valeur;
    }

    public function setValeur(float $valeur): self
    {
        $this->valeur = $valeur;

        return $this;
    }

    public function getCaracteristique(): ?Caracteristique
    {
        return $this->caracteristique;
    }

    public function setCaracteristique(?Caracteristique $caracteristique): self
    {
        $this->caracteristique = $caracteristique;

        return $this;
    }

    public function getPersonnage(): ?Personnage
    {
        return $this->personnage;
    }

    public function setPersonnage(?Personnage $personnage): self
    {
        $this->personnage = $personnage;

        return $this;
    }

    public function getRace(): ?Race
    {
        return $this->race;
    }

    public function setRace(?Race $race): self
    {
        $this->race = $race;

        return $this;
    }
}
