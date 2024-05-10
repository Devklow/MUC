<?php

namespace App\Entity;

use App\Repository\AttributRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AttributRepository::class)
 */
class Attribut
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
     * @ORM\ManyToOne(targetEntity=TypeAttribut::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $typeAttribut;

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

    public function getTypeAttribut(): ?TypeAttribut
    {
        return $this->typeAttribut;
    }

    public function setTypeAttribut(?TypeAttribut $typeAttribut): self
    {
        $this->typeAttribut = $typeAttribut;

        return $this;
    }
}
