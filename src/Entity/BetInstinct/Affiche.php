<?php

namespace App\Entity\BetInstinct;

use App\Repository\BetInstinct\AfficheRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AfficheRepository::class)
 */
class Affiche
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Tournoi::class, inversedBy="affiches")
     * @ORM\JoinColumn(nullable=false)
     */
    private $tournoi;

    /**
     * @ORM\ManyToOne(targetEntity=Athlete::class, inversedBy="affiches_favori")
     * @ORM\JoinColumn(nullable=false)
     */
    private $favori;

    /**
     * @ORM\ManyToOne(targetEntity=Athlete::class, inversedBy="affiches_challenger")
     * @ORM\JoinColumn(nullable=false)
     */
    private $challenger;

    /**
     * @ORM\Column(type="datetime")
     */
    private $schedule;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $score;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $cote_favorite;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $cote_outsider;

    /**
     * @ORM\OneToMany(targetEntity=Pari::class, mappedBy="affiche")
     */
    private $paris;

    public function __construct()
    {
        $this->paris = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getFavori(): ?Athlete
    {
        return $this->favori;
    }

    public function setFavori(?Athlete $favori): self
    {
        $this->favori = $favori;

        return $this;
    }

    public function getChallenger(): ?Athlete
    {
        return $this->challenger;
    }

    public function setChallenger(?Athlete $challenger): self
    {
        $this->challenger = $challenger;

        return $this;
    }

    public function getSchedule(): ?\DateTimeInterface
    {
        return $this->schedule;
    }

    public function setSchedule(\DateTimeInterface $schedule): self
    {
        $this->schedule = $schedule;

        return $this;
    }

    public function getScore(): ?string
    {
        return $this->score;
    }

    public function setScore(string $score): self
    {
        $this->score = $score;

        return $this;
    }

    public function getCoteFavorite(): ?float
    {
        return $this->cote_favorite;
    }

    public function setCoteFavorite(?float $cote_favorite): self
    {
        $this->cote_favorite = $cote_favorite;

        return $this;
    }

    public function getCoteOutsider(): ?float
    {
        return $this->cote_outsider;
    }

    public function setCoteOutsider(?float $cote_outsider): self
    {
        $this->cote_outsider = $cote_outsider;

        return $this;
    }

    /**
     * @return Collection|Pari[]
     */
    public function getParis(): Collection
    {
        return $this->paris;
    }

    public function addPari(Pari $pari): self
    {
        if (!$this->paris->contains($pari)) {
            $this->paris[] = $pari;
            $pari->setAffiche($this);
        }

        return $this;
    }

    public function removePari(Pari $pari): self
    {
        if ($this->paris->removeElement($pari)) {
            // set the owning side to null (unless already changed)
            if ($pari->getAffiche() === $this) {
                $pari->setAffiche(null);
            }
        }

        return $this;
    }
}
