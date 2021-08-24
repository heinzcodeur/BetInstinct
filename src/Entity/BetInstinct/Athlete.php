<?php

namespace App\Entity\BetInstinct;

use App\Repository\BetInstinct\AthleteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AthleteRepository::class)
 */
class Athlete
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
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\Column(type="datetime")
     */
    private $birthdate;

    /**
     * @ORM\ManyToOne(targetEntity=Pays::class, inversedBy="athletes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $pays;

    /**
     * @ORM\ManyToOne(targetEntity=Pays::class, inversedBy="athletes_origine")
     */
    private $origine;

    /**
     * @ORM\Column(type="float")
     */
    private $taille;

    /**
     * @ORM\OneToMany(targetEntity=Affiche::class, mappedBy="favori")
     */
    private $affiches_favori;

    /**
     * @ORM\OneToMany(targetEntity=Affiche::class, mappedBy="challenger")
     */
    private $affiches_challenger;

    /**
     * @ORM\OneToMany(targetEntity=Tournoi::class, mappedBy="tenant_titre")
     */
    private $titres;

    /**
     * @ORM\OneToOne(targetEntity=Classement::class, inversedBy="joueur", cascade={"persist", "remove"})
     */
    private $ranking;


    public function __construct()
    {
        $this->affiches_favori = new ArrayCollection();
        $this->affiches_challenger = new ArrayCollection();
        $this->titres = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->nom;
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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getBirthdate(): ?\DateTimeInterface
    {
        return $this->birthdate;
    }

    public function setBirthdate(\DateTimeInterface $birthdate): self
    {
        $this->birthdate = $birthdate;

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

    public function getOrigine(): ?Pays
    {
        return $this->origine;
    }

    public function setOrigine(?Pays $origine): self
    {
        $this->origine = $origine;

        return $this;
    }

    public function getTaille(): ?float
    {
        return $this->taille;
    }

    public function setTaille(float $taille): self
    {
        $this->taille = $taille;

        return $this;
    }

    /**
     * @return Collection|Affiche[]
     */
    public function getAffichesFavori(): Collection
    {
        return $this->affiches_favori;
    }

    public function addAffichesFavori(Affiche $affichesFavori): self
    {
        if (!$this->affiches_favori->contains($affichesFavori)) {
            $this->affiches_favori[] = $affichesFavori;
            $affichesFavori->setFavori($this);
        }

        return $this;
    }

    public function removeAffichesFavori(Affiche $affichesFavori): self
    {
        if ($this->affiches_favori->removeElement($affichesFavori)) {
            // set the owning side to null (unless already changed)
            if ($affichesFavori->getFavori() === $this) {
                $affichesFavori->setFavori(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Affiche[]
     */
    public function getAffichesChallenger(): Collection
    {
        return $this->affiches_challenger;
    }

    public function addAffichesChallenger(Affiche $affichesChallenger): self
    {
        if (!$this->affiches_challenger->contains($affichesChallenger)) {
            $this->affiches_challenger[] = $affichesChallenger;
            $affichesChallenger->setChallenger($this);
        }

        return $this;
    }

    public function removeAffichesChallenger(Affiche $affichesChallenger): self
    {
        if ($this->affiches_challenger->removeElement($affichesChallenger)) {
            // set the owning side to null (unless already changed)
            if ($affichesChallenger->getChallenger() === $this) {
                $affichesChallenger->setChallenger(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Tournoi[]
     */
    public function getTitres(): Collection
    {
        return $this->titres;
    }

    public function addTitre(Tournoi $titre): self
    {
        if (!$this->titres->contains($titre)) {
            $this->titres[] = $titre;
            $titre->setTenantTitre($this);
        }

        return $this;
    }

    public function removeTitre(Tournoi $titre): self
    {
        if ($this->titres->removeElement($titre)) {
            // set the owning side to null (unless already changed)
            if ($titre->getTenantTitre() === $this) {
                $titre->setTenantTitre(null);
            }
        }

        return $this;
    }

    public function getRanking(): ?Classement
    {
        return $this->ranking;
    }

    public function setRanking(?Classement $ranking): self
    {
        $this->ranking = $ranking;

        return $this;
    }

}
