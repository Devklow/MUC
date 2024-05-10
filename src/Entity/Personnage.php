<?php

namespace App\Entity;

use App\Repository\PersonnageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PersonnageRepository::class)
 */
class Personnage
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
     * @ORM\Column(type="integer")
     */
    private $age;

    /**
     * @ORM\Column(type="float")
     */
    private $experience;

    /**
     * @ORM\Column(type="text")
     */
    private $histoire;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity=Race::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $race;

    /**
     * @ORM\OneToMany(targetEntity=StatistiquePossede::class, mappedBy="personnage")
     */
    private $statistiques;

    /**
     * @ORM\ManyToMany(targetEntity=Lieu::class)
     */
    private $lieus;

    /**
     * @ORM\ManyToMany(targetEntity=Competence::class)
     */
    private $competences;

    /**
     * @ORM\OneToMany(targetEntity=ObjetPossede::class, mappedBy="personnage")
     */
    private $objets;

    /**
     * @ORM\ManyToMany(targetEntity=Attribut::class)
     */
    private $attributs;

    /**
     * @ORM\OneToMany(targetEntity=CaracteristiquePossede::class, mappedBy="personnage")
     */
    private $caracteristiques;

    /**
     * @ORM\ManyToOne(targetEntity=Niveau::class)
     */
    private $niveau;

    /**
     * @ORM\ManyToMany(targetEntity=Sort::class)
     */
    private $sorts;

    public function __construct()
    {
        $this->statistiques = new ArrayCollection();
        $this->lieus = new ArrayCollection();
        $this->competences = new ArrayCollection();
        $this->objets = new ArrayCollection();
        $this->attributs = new ArrayCollection();
        $this->caracteristiques = new ArrayCollection();
        $this->sorts = new ArrayCollection();
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

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): self
    {
        $this->age = $age;

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

    public function getHistoire(): ?string
    {
        return $this->histoire;
    }

    public function setHistoire(string $histoire): self
    {
        $this->histoire = $histoire;

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

    public function getRace(): ?Race
    {
        return $this->race;
    }

    public function setRace(?Race $race): self
    {
        $this->race = $race;

        return $this;
    }

    /**
     * @return Collection<int, StatistiquePossede>
     */
    public function getStatistiques(): Collection
    {
        return $this->statistiques;
    }

    public function addStatistique(StatistiquePossede $statistique): self
    {
        if (!$this->statistiques->contains($statistique)) {
            $this->statistiques[] = $statistique;
            $statistique->setPersonnage($this);
        }

        return $this;
    }

    public function removeStatistique(StatistiquePossede $statistique): self
    {
        if ($this->statistiques->removeElement($statistique)) {
            // set the owning side to null (unless already changed)
            if ($statistique->getPersonnage() === $this) {
                $statistique->setPersonnage(null);
            }
        }

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
     * @return Collection<int, Competence>
     */
    public function getCompetences(): Collection
    {
        return $this->competences;
    }

    public function addCompetence(Competence $competence): self
    {
        if (!$this->competences->contains($competence)) {
            $this->competences[] = $competence;
        }

        return $this;
    }

    public function removeCompetence(Competence $competence): self
    {
        $this->competences->removeElement($competence);

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
            $objet->setPersonnage($this);
        }

        return $this;
    }

    public function removeObjet(ObjetPossede $objet): self
    {
        if ($this->objets->removeElement($objet)) {
            // set the owning side to null (unless already changed)
            if ($objet->getPersonnage() === $this) {
                $objet->setPersonnage(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Attribut>
     */
    public function getAttributs(): Collection
    {
        return $this->attributs;
    }

    public function addAttribut(Attribut $attribut): self
    {
        if (!$this->attributs->contains($attribut)) {
            $this->attributs[] = $attribut;
        }

        return $this;
    }

    public function removeAttribut(Attribut $attribut): self
    {
        $this->attributs->removeElement($attribut);

        return $this;
    }

    /**
     * @return Collection<int, CaracteristiquePossede>
     */
    public function getCaracteristiques(): Collection
    {
        return $this->caracteristiques;
    }

    public function addCaracteristique(CaracteristiquePossede $caracteristique): self
    {
        if (!$this->caracteristiques->contains($caracteristique)) {
            $this->caracteristiques[] = $caracteristique;
            $caracteristique->setPersonnage($this);
        }

        return $this;
    }

    public function removeCaracteristique(CaracteristiquePossede $caracteristique): self
    {
        if ($this->caracteristiques->removeElement($caracteristique)) {
            // set the owning side to null (unless already changed)
            if ($caracteristique->getPersonnage() === $this) {
                $caracteristique->setPersonnage(null);
            }
        }

        return $this;
    }

    public function getNiveau(): ?Niveau
    {
        return $this->niveau;
    }

    public function setNiveau(?Niveau $niveau): self
    {
        $this->niveau = $niveau;

        return $this;
    }

    /**
     * @return Collection<int, Sort>
     */
    public function getSorts(): Collection
    {
        return $this->sorts;
    }

    public function addSort(Sort $sort): self
    {
        if (!$this->sorts->contains($sort)) {
            $this->sorts[] = $sort;
        }

        return $this;
    }

    public function removeSort(Sort $sort): self
    {
        $this->sorts->removeElement($sort);

        return $this;
    }
}
