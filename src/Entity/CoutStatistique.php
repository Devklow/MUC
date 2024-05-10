<?php

namespace App\Entity;

use App\Repository\CoutStatistiqueRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CoutStatistiqueRepository::class)
 */
class CoutStatistique
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
     * @ORM\Column(type="string", length=255)
     */
    private $info;

    /**
     * @ORM\ManyToOne(targetEntity=Sort::class, inversedBy="coutStatistiques")
     */
    private $sort;

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

    public function getInfo(): ?string
    {
        return $this->info;
    }

    public function setInfo(string $info): self
    {
        $this->info = $info;

        return $this;
    }

    public function getSort(): ?Sort
    {
        return $this->sort;
    }

    public function setSort(?Sort $sort): self
    {
        $this->sort = $sort;

        return $this;
    }
}
