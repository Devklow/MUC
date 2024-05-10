<?php

namespace App\Entity;

use App\Repository\StatistiquePossedeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StatistiquePossedeRepository::class)
 */
class StatistiquePossede
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $valeur;

    /**
     * @ORM\Column(type="integer")
     */
    private $max;

    /**
     * @ORM\Column(type="integer")
     */
    private $bonus;

    /**
     * @ORM\ManyToOne(targetEntity=Statistique::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $statistique;

    /**
     * @ORM\ManyToOne(targetEntity=Personnage::class, inversedBy="statistiques")
     */
    private $personnage;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getValeur(): ?int
    {
        return $this->valeur;
    }

    public function setValeur(int $valeur): self
    {
        $this->valeur = $valeur;

        return $this;
    }

    public function getMax(): ?int
    {
        return $this->max;
    }

    public function setMax(int $max): self
    {
        $this->max = $max;

        return $this;
    }

    public function getBonus(): ?int
    {
        return $this->bonus;
    }

    public function setBonus(int $bonus): self
    {
        $this->bonus = $bonus;

        return $this;
    }

    public function getStatistique(): ?Statistique
    {
        return $this->statistique;
    }

    public function setStatistique(?Statistique $statistique): self
    {
        $this->statistique = $statistique;

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
}
