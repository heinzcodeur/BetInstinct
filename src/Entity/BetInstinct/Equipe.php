<?php

namespace App\Entity\BetInstinct;

use App\Repository\BetInstinct\EquipeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EquipeRepository::class)
 */
class Equipe
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity=Sport::class, inversedBy="equipes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $sport;

    /**
     * @ORM\ManyToOne(targetEntity=Pays::class, inversedBy="equipes")
     */
    private $pays;

    /**
     * @ORM\ManyToMany(targetEntity=Athlete::class, inversedBy="equipes")
     */
    private $joueurs;

    /**
     * @ORM\OneToMany(targetEntity=Affiche::class, mappedBy="equipeA")
     */
    private $affiches;

    /**
     * @ORM\ManyToOne(targetEntity=Tournoi::class, inversedBy="equipes")
     */
    private $tournoi;

    public function __toString()
    {
        return $this->name;
    }

    public function __construct()
    {
        $this->joueurs = new ArrayCollection();
        $this->affiches = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getSport(): ?Sport
    {
        return $this->sport;
    }

    public function setSport(?Sport $sport): self
    {
        $this->sport = $sport;

        return $this;
    }

    public function getPays(): ?Pays
    {
        return $this->pays;
    }

    public function setPays(?Pays $pays): self
    {
        $this->pays = $pays;

        return $this;
    }

    /**
     * @return Collection|Athlete[]
     */
    public function getJoueurs(): Collection
    {
        return $this->joueurs;
    }

    public function addJoueur(Athlete $joueur): self
    {
        if (!$this->joueurs->contains($joueur)) {
            $this->joueurs[] = $joueur;
        }

        return $this;
    }

    public function removeJoueur(Athlete $joueur): self
    {
        $this->joueurs->removeElement($joueur);

        return $this;
    }

    /**
     * @return Collection|Affiche[]
     */
    public function getAffiches(): Collection
    {
        return $this->affiches;
    }

    public function addAffich(Affiche $affich): self
    {
        if (!$this->affiches->contains($affich)) {
            $this->affiches[] = $affich;
            $affich->setEquipeA($this);
        }

        return $this;
    }

    public function removeAffich(Affiche $affich): self
    {
        if ($this->affiches->removeElement($affich)) {
            // set the owning side to null (unless already changed)
            if ($affich->getEquipeA() === $this) {
                $affich->setEquipeA(null);
            }
        }

        return $this;
    }

    public function getTournoi(): ?Tournoi
    {
        return $this->tournoi;
    }

    public function setTournoi(?Tournoi $tournoi): self
    {
        $this->tournoi = $tournoi;

        return $this;
    }
}
