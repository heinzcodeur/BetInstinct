<?php

namespace App\Entity\BetInstinct;

use App\Repository\BetInstinct\TournoiRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TournoiRepository::class)
 */
class Tournoi
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $debut;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $fin;

    /**
     * @ORM\ManyToOne(targetEntity=City::class, inversedBy="tournois")
     * @ORM\JoinColumn(nullable=false)
     */
    private $city;

    /**
     * @ORM\ManyToOne(targetEntity=Surface::class, inversedBy="tournois")
     * @ORM\JoinColumn(nullable=false)
     */
    private $surface;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $date_creation;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $siteweb;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $dotation;

    /**
     * @ORM\OneToMany(targetEntity=Affiche::class, mappedBy="tournoi")
     */
    private $affiches;

    /**
     * @ORM\ManyToOne(targetEntity=Athlete::class, inversedBy="titres")
     */
    private $tenant_titre;

    public function __construct()
    {
        $this->affiches = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDebut(): ?\DateTimeInterface
    {
        return $this->debut;
    }

    public function setDebut(?\DateTimeInterface $debut): self
    {
        $this->debut = $debut;

        return $this;
    }

    public function getFin(): ?\DateTimeInterface
    {
        return $this->fin;
    }

    public function setFin(?\DateTimeInterface $fin): self
    {
        $this->fin = $fin;

        return $this;
    }

    public function getCity(): ?City
    {
        return $this->city;
    }

    public function setCity(?City $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getSurface(): ?Surface
    {
        return $this->surface;
    }

    public function setSurface(?Surface $surface): self
    {
        $this->surface = $surface;

        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->date_creation;
    }

    public function setDateCreation(?\DateTimeInterface $date_creation): self
    {
        $this->date_creation = $date_creation;

        return $this;
    }

    public function getSiteweb(): ?string
    {
        return $this->siteweb;
    }

    public function setSiteweb(?string $siteweb): self
    {
        $this->siteweb = $siteweb;

        return $this;
    }

    public function getDotation(): ?int
    {
        return $this->dotation;
    }

    public function setDotation(?int $dotation): self
    {
        $this->dotation = $dotation;

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
            $affich->setTournoi($this);
        }

        return $this;
    }

    public function removeAffich(Affiche $affich): self
    {
        if ($this->affiches->removeElement($affich)) {
            // set the owning side to null (unless already changed)
            if ($affich->getTournoi() === $this) {
                $affich->setTournoi(null);
            }
        }

        return $this;
    }

    public function getTenantTitre(): ?Athlete
    {
        return $this->tenant_titre;
    }

    public function setTenantTitre(?Athlete $tenant_titre): self
    {
        $this->tenant_titre = $tenant_titre;

        return $this;
    }
}
