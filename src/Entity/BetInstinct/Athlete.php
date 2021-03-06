<?php

namespace App\Entity\BetInstinct;

use App\Entity\BetInstinct\Document;
use App\Repository\BetInstinct\AthleteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity
 * @Vich\Uploadable
 */
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
     * @var string|null
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $avatar;

    /**
     * @Vich\UploadableField(mapping="images_athletes", fileNameProperty="avatar")
     * @var File
     */
    private $imageFile;

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

    /**
     * @ORM\ManyToOne(targetEntity=City::class, inversedBy="athletes")
     */
    private $birth_place;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updated_at;

    /**
     * @ORM\ManyToMany(targetEntity=Equipe::class, mappedBy="joueurs")
     */
    private $equipes;

    /**
     * @ORM\OneToMany(targetEntity=Document::class, mappedBy="athete")
     */
    private $documents;

    /**
     * @ORM\Column(type="string", length=255, nullable=true, columnDefinition="ENUM('homme','dame')")
     */
    private $genre;


    public function __construct()
    {
        $this->affiches_favori = new ArrayCollection();
        $this->affiches_challenger = new ArrayCollection();
        $this->titres = new ArrayCollection();
        $this->equipes = new ArrayCollection();
        $this->documents = new ArrayCollection();
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

    /**
     * @return mixed
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * @param mixed $avatar
     * @return Athlete
     */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getImageFile()
    {
        return $this->imageFile;
    }

    /**
     * @param mixed $imageFile
     * @return Athlete
     */
    public function setImageFile(File $avatar = null)
    {
        $this->imageFile = $avatar;

        if($avatar){

            $this->updated_at = new \DateTime('now');
        }

       // return $this;
    }

    public function getBirthPlace(): ?City
    {
        return $this->birth_place;
    }

    public function setBirthPlace(?City $birth_place): self
    {
        $this->birth_place = $birth_place;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    /**
     * @return Collection|Equipe[]
     */
    public function getEquipes(): Collection
    {
        return $this->equipes;
    }

    public function addEquipe(Equipe $equipe): self
    {
        if (!$this->equipes->contains($equipe)) {
            $this->equipes[] = $equipe;
            $equipe->addJoueur($this);
        }

        return $this;
    }

    public function removeEquipe(Equipe $equipe): self
    {
        if ($this->equipes->removeElement($equipe)) {
            $equipe->removeJoueur($this);
        }

        return $this;
    }

    /**
     * @return Collection|Document[]
     */
    public function getDocuments(): Collection
    {
        return $this->documents;
    }

    public function addDocument(Document $document): self
    {
        if (!$this->documents->contains($document)) {
            $this->documents[] = $document;
            $document->setAthete($this);
        }

        return $this;
    }

    public function removeDocument(Document $document): self
    {
        if ($this->documents->removeElement($document)) {
            // set the owning side to null (unless already changed)
            if ($document->getAthete() === $this) {
                $document->setAthete(null);
            }
        }

        return $this;
    }

    public function getGenre(): ?string
    {
        return $this->genre;
    }

    public function setGenre(?string $genre): self
    {
        $this->genre = $genre;

        return $this;
    }



}
