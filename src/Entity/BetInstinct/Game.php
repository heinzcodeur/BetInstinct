<?php

namespace App\Entity\BetInstinct;

use App\Repository\BetInstinct\GameRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GameRepository::class)
 */
class Game
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
     * @ORM\OneToMany(targetEntity=Pronostic::class, mappedBy="game1")
     */
    private $pronostics;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $created;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updated;

    /**
     * @ORM\ManyToOne(targetEntity=Formule::class, inversedBy="games")
     */
    private $formule;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $cote_totale;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $mise;

    /**
     * @ORM\Column(type="string", length=255, columnDefinition="ENUM('en attente','gagnant','perdant')")
     */
    private $resultat;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $gain;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="games")
     */
    private $parieur;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isConfirm;

    /**
     * @ORM\OneToMany(targetEntity=Transaction::class, mappedBy="game")
     */
    private $transactions;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isArchived;

    /**
     * @ORM\ManyToOne(targetEntity=Game::class, inversedBy="underGames")
     */
    private $parent;

    /**
     * @ORM\OneToMany(targetEntity=Game::class, mappedBy="parent")
     */
    private $underGames;

    public function __toString()
    {
        return $this->name.' '.$this->created->format('d-m-Y');

    }

    public function __construct()
    {
        $this->pronostics = new ArrayCollection();
        $this->transactions = new ArrayCollection();
        $this->underGames = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

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
            $pronostic->setGame1($this);
        }

        return $this;
    }

    public function removePronostic(Pronostic $pronostic): self
    {
        if ($this->pronostics->removeElement($pronostic)) {
            // set the owning side to null (unless already changed)
            if ($pronostic->getGame1() === $this) {
                $pronostic->setGame1(null);
            }
        }

        return $this;
    }

    public function getCreated(): ?\DateTimeInterface
    {
        return $this->created;
    }

    public function setCreated(?\DateTimeInterface $created): self
    {
        $this->created = $created;

        return $this;
    }

    public function getUpdated(): ?\DateTimeInterface
    {
        return $this->updated;
    }

    public function setUpdated(?\DateTimeInterface $updated): self
    {
        $this->updated = $updated;

        return $this;
    }

    public function getFormule(): ?Formule
    {
        return $this->formule;
    }

    public function setFormule(?Formule $formule): self
    {
        $this->formule = $formule;

        return $this;
    }

    public function getCoteTotale(): ?float
    {
        return $this->cote_totale;
    }

    public function setCoteTotale(?float $cote_totale): self
    {
        $this->cote_totale = $cote_totale;

        return $this;
    }

    public function getMise(): ?float
    {
        return $this->mise;
    }

    public function setMise(?float $mise): self
    {
        $this->mise = $mise;

        return $this;
    }

    public function getResultat(): ?string
    {
        return $this->resultat;
    }

    public function setResultat(?string $resultat): self
    {
        $this->resultat = $resultat;

        return $this;
    }

    public function getGain(): ?float
    {
        return $this->gain;
    }

    public function setGain(?float $gain): self
    {
        $this->gain = $gain;

        return $this;
    }

    public function getParieur(): ?User
    {
        return $this->parieur;
    }

    public function setParieur(?User $parieur): self
    {
        $this->parieur = $parieur;

        return $this;
    }

    public function getIsConfirm(): ?bool
    {
        return $this->isConfirm;
    }

    public function setIsConfirm(?bool $isConfirm): self
    {
        $this->isConfirm = $isConfirm;

        return $this;
    }

    /**
     * @return Collection|Transaction[]
     */
    public function getTransactions(): Collection
    {
        return $this->transactions;
    }

    public function addTransaction(Transaction $transaction): self
    {
        if (!$this->transactions->contains($transaction)) {
            $this->transactions[] = $transaction;
            $transaction->setGame($this);
        }

        return $this;
    }

    public function removeTransaction(Transaction $transaction): self
    {
        if ($this->transactions->removeElement($transaction)) {
            // set the owning side to null (unless already changed)
            if ($transaction->getGame() === $this) {
                $transaction->setGame(null);
            }
        }

        return $this;
    }

    public function getIsArchived(): ?bool
    {
        return $this->isArchived;
    }

    public function setIsArchived(?bool $isArchived): self
    {
        $this->isArchived = $isArchived;

        return $this;
    }

    public function getParent(): ?self
    {
        return $this->parent;
    }

    public function setParent(?self $parent): self
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getUnderGames(): Collection
    {
        return $this->underGames;
    }

    public function addUnderGame(self $underGame): self
    {
        if (!$this->underGames->contains($underGame)) {
            $this->underGames[] = $underGame;
            $underGame->setParent($this);
        }

        return $this;
    }

    public function removeUnderGame(self $underGame): self
    {
        if ($this->underGames->removeElement($underGame)) {
            // set the owning side to null (unless already changed)
            if ($underGame->getParent() === $this) {
                $underGame->setParent(null);
            }
        }

        return $this;
    }
}
