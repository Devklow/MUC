<?php

namespace App\Entity;

use App\Repository\LieuRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LieuRepository::class)
 */
class Lieu
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
     * @ORM\ManyToOne(targetEntity=LieuType::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $lieuType;

    /**
     * @ORM\ManyToMany(targetEntity=Lieu::class)
     */
    private $lieus;

    public function __construct()
    {
        $this->lieus = new ArrayCollection();
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

    public function getLieuType(): ?LieuType
    {
        return $this->lieuType;
    }

    public function setLieuType(?LieuType $lieuType): self
    {
        $this->lieuType = $lieuType;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getLieus(): Collection
    {
        return $this->lieus;
    }

    public function addLieu(self $lieu): self
    {
        if (!$this->lieus->contains($lieu)) {
            $this->lieus[] = $lieu;
        }

        return $this;
    }

    public function removeLieu(self $lieu): self
    {
        $this->lieus->removeElement($lieu);

        return $this;
    }
}
