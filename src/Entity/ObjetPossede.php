<?php

namespace App\Entity;

use App\Repository\ObjetPossedeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ObjetPossedeRepository::class)
 */
class ObjetPossede
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
    private $nombre;

    /**
     * @ORM\Column(type="boolean")
     */
    private $estEquipe;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $info;

    /**
     * @ORM\ManyToOne(targetEntity=Objet::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $objet;

    /**
     * @ORM\ManyToOne(targetEntity=Personnage::class, inversedBy="objets")
     */
    private $personnage;

    /**
     * @ORM\ManyToOne(targetEntity=Quete::class, inversedBy="objets")
     */
    private $quete;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?float
    {
        return $this->nombre;
    }

    public function setNombre(float $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function isEstEquipe(): ?bool
    {
        return $this->estEquipe;
    }

    public function setEstEquipe(bool $estEquipe): self
    {
        $this->estEquipe = $estEquipe;

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

    public function getObjet(): ?Objet
    {
        return $this->objet;
    }

    public function setObjet(?Objet $objet): self
    {
        $this->objet = $objet;

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

    public function getQuete(): ?Quete
    {
        return $this->quete;
    }

    public function setQuete(?Quete $quete): self
    {
        $this->quete = $quete;

        return $this;
    }
}
