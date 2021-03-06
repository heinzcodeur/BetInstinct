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

    /**
     * @ORM\OneToMany(targetEntity=TypoPari::class, mappedBy="affiche")
     */
    private $typoParis;

    /**
     * @ORM\OneToMany(targetEntity=Vainqueur::class, mappedBy="affiche")
     */
    private $vainqueurs;

    /**
     * @ORM\OneToMany(targetEntity=nombre2sets::class, mappedBy="affiche")
     */
    private $nombre2sets;

    /**
     * @ORM\OneToMany(targetEntity=Les2joueursWin1set::class, mappedBy="affiche")
     */
    private $les2joueursWin1sets;

    /**
     * @ORM\OneToMany(targetEntity=Bet::class, mappedBy="affiche")
     */
    private $bet;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $archived;

    /**
     * @ORM\OneToMany(targetEntity=Pronostic::class, mappedBy="affiche")
     */
    private $pronostics;

    /**
     * @ORM\ManyToOne(targetEntity=Equipe::class, inversedBy="affiches")
     */
    private $equipeA;

    /**
     * @ORM\ManyToOne(targetEntity=Equipe::class, inversedBy="affiches")
     */
    private $EquipeB;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $Cote_match_null;

    /**
     * @ORM\Column(type="string", length=255, nullable=true, columnDefinition="ENUM('1','2','3','4')")
     */
    private $niveau;


    public function __construct()
    {
        $this->paris = new ArrayCollection();
        $this->typoParis = new ArrayCollection();
        $this->vainqueurs = new ArrayCollection();
        $this->nombre2sets = new ArrayCollection();
        $this->les2joueursWin1sets = new ArrayCollection();
        $this->bet = new ArrayCollection();
        $this->pronostics = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->favori.' VS '.$this->challenger;
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

    /**
     * @return Collection|TypoPari[]
     */
    public function getTypoParis(): Collection
    {
        return $this->typoParis;
    }

    public function addTypoPari(TypoPari $typoPari): self
    {
        if (!$this->typoParis->contains($typoPari)) {
            $this->typoParis[] = $typoPari;
            $typoPari->setAffiche($this);
        }

        return $this;
    }

    public function removeTypoPari(TypoPari $typoPari): self
    {
        if ($this->typoParis->removeElement($typoPari)) {
            // set the owning side to null (unless already changed)
            if ($typoPari->getAffiche() === $this) {
                $typoPari->setAffiche(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Vainqueur[]
     */
    public function getVainqueurs(): Collection
    {
        return $this->vainqueurs;
    }

    public function addVainqueur(Vainqueur $vainqueur): self
    {
        if (!$this->vainqueurs->contains($vainqueur)) {
            $this->vainqueurs[] = $vainqueur;
            $vainqueur->setAffiche($this);
        }

        return $this;
    }

    public function removeVainqueur(Vainqueur $vainqueur): self
    {
        if ($this->vainqueurs->removeElement($vainqueur)) {
            // set the owning side to null (unless already changed)
            if ($vainqueur->getAffiche() === $this) {
                $vainqueur->setAffiche(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|nombre2sets[]
     */
    public function getNombre2sets(): Collection
    {
        return $this->nombre2sets;
    }

    public function addNombre2set(nombre2sets $nombre2set): self
    {
        if (!$this->nombre2sets->contains($nombre2set)) {
            $this->nombre2sets[] = $nombre2set;
            $nombre2set->setAffiche($this);
        }

        return $this;
    }

    public function removeNombre2set(nombre2sets $nombre2set): self
    {
        if ($this->nombre2sets->removeElement($nombre2set)) {
            // set the owning side to null (unless already changed)
            if ($nombre2set->getAffiche() === $this) {
                $nombre2set->setAffiche(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Les2joueursWin1set[]
     */
    public function getLes2joueursWin1sets(): Collection
    {
        return $this->les2joueursWin1sets;
    }

    public function addLes2joueursWin1set(Les2joueursWin1set $les2joueursWin1set): self
    {
        if (!$this->les2joueursWin1sets->contains($les2joueursWin1set)) {
            $this->les2joueursWin1sets[] = $les2joueursWin1set;
            $les2joueursWin1set->setAffiche($this);
        }

        return $this;
    }

    public function removeLes2joueursWin1set(Les2joueursWin1set $les2joueursWin1set): self
    {
        if ($this->les2joueursWin1sets->removeElement($les2joueursWin1set)) {
            // set the owning side to null (unless already changed)
            if ($les2joueursWin1set->getAffiche() === $this) {
                $les2joueursWin1set->setAffiche(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Bet[]
     */
    public function getBet(): Collection
    {
        return $this->bet;
    }

    public function addBet(Bet $bet): self
    {
        if (!$this->bet->contains($bet)) {
            $this->bet[] = $bet;
            $bet->setAffiche($this);
        }

        return $this;
    }

    public function removeBet(Bet $bet): self
    {
        if ($this->bet->removeElement($bet)) {
            // set the owning side to null (unless already changed)
            if ($bet->getAffiche() === $this) {
                $bet->setAffiche(null);
            }
        }

        return $this;
    }

    public function getArchived(): ?bool
    {
        return $this->archived;
    }

    public function setArchived(?bool $archived): self
    {
        $this->archived = $archived;

        return $this;
    }

    /**
     * @return Collection|Pronostic[]
     */
    public function getPronostics(): Collection
    {
        return $this->pronostics;
    }

    public function addPronostic(Pronostic $pronostic): self
    {
        if (!$this->pronostics->contains($pronostic)) {
            $this->pronostics[] = $pronostic;
            $pronostic->setAffiche($this);
        }

        return $this;
    }

    public function removePronostic(Pronostic $pronostic): self
    {
        if ($this->pronostics->removeElement($pronostic)) {
            // set the owning side to null (unless already changed)
            if ($pronostic->getAffiche() === $this) {
                $pronostic->setAffiche(null);
            }
        }

        return $this;
    }

    public function getEquipeA(): ?Equipe
    {
        return $this->equipeA;
    }

    public function setEquipeA(?Equipe $equipeA): self
    {
        $this->equipeA = $equipeA;

        return $this;
    }

    public function getEquipeB(): ?Equipe
    {
        return $this->EquipeB;
    }

    public function setEquipeB(?Equipe $EquipeB): self
    {
        $this->EquipeB = $EquipeB;

        return $this;
    }

    public function getCoteMatchNull(): ?float
    {
        return $this->Cote_match_null;
    }

    public function setCoteMatchNull(?float $Cote_match_null): self
    {
        $this->Cote_match_null = $Cote_match_null;

        return $this;
    }

    public function getNiveau(): ?string
    {
        return $this->niveau;
    }

    public function setNiveau(?string $niveau): self
    {
        $this->niveau = $niveau;

        return $this;
    }

    }
