<?php

namespace App\Entity\BetInstinct;

use App\Repository\BetInstinct\JeuRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=JeuRepository::class)
 */
class Jeu
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Formule::class, inversedBy="jeux")
     * @ORM\JoinColumn(nullable=false)
     */
    private $formule;

    /**
     * @ORM\OneToOne(targetEntity=Pronostic::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $pronostic;

    /**
     * @ORM\Column(type="float")
     */
    private $mise;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updated_at;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="jeux")
     */
    private $parieur;


    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $gain_final;

    /**
     * @ORM\Column(type="string", length=255, columnDefinition="ENUM('en attente','perdant','gagnant')")
     */
    private $resultat;

    /**
     * @ORM\OneToMany(targetEntity=Transaction::class, mappedBy="jeu")
     */
    private $transactions;

    /**
     * @ORM\OneToOne(targetEntity=Pronostic::class, cascade={"persist", "remove"})
     */
    private $pronostic2;

    /**
     * @ORM\OneToOne(targetEntity=Pronostic::class, cascade={"persist", "remove"})
     */
    private $pronostic3;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $cote_totale;

    /**
     * @ORM\OneToMany(targetEntity=Pronostic::class, mappedBy="game")
     */
    private $prono;

    public function __construct()
    {
        $this->transactions = new ArrayCollection();
        $this->prono = new ArrayCollection();
    }

    public function __toString()
    {
        return (string)$this->pronostic->getBet()->getAffiche().' '.$this->pronostic->getBet()->getTypedePari()->getType2choix().' par '.ucfirst($this->parieur->getNickname());
        //return (string)$this->pronostic;
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getPronostic(): ?Pronostic
    {
        return $this->pronostic;
    }

    public function setPronostic(Pronostic $pronostic): self
    {
        $this->pronostic = $pronostic;

        return $this;
    }

    public function getMise(): ?float
    {
        return $this->mise;
    }

    public function setMise(float $mise): self
    {
        $this->mise = $mise;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(?\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(?\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

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

    public function getGainFinal(): ?float
    {
        return $this->gain_final;
    }

    public function setGainFinal(?float $gain_final): self
    {
        $this->gain_final = $gain_final;

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
            $transaction->setJeu($this);
        }

        return $this;
    }

    public function removeTransaction(Transaction $transaction): self
    {
        if ($this->transactions->removeElement($transaction)) {
            // set the owning side to null (unless already changed)
            if ($transaction->getJeu() === $this) {
                $transaction->setJeu(null);
            }
        }

        return $this;
    }

    public function getPronostic2(): ?Pronostic
    {
        return $this->pronostic2;
    }

    public function setPronostic2(?Pronostic $pronostic2): self
    {
        $this->pronostic2 = $pronostic2;

        return $this;
    }

    public function getPronostic3(): ?Pronostic
    {
        return $this->pronostic3;
    }

    public function setPronostic3(?Pronostic $pronostic3): self
    {
        $this->pronostic3 = $pronostic3;

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

    /**
     * @return Collection|Pronostic[]
     */
    public function getProno(): Collection
    {
        return $this->prono;
    }

    public function addProno(Pronostic $prono): self
    {
        if (!$this->prono->contains($prono)) {
            $this->prono[] = $prono;
            $prono->setGame($this);
        }

        return $this;
    }

    public function removeProno(Pronostic $prono): self
    {
        if ($this->prono->removeElement($prono)) {
            // set the owning side to null (unless already changed)
            if ($prono->getGame() === $this) {
                $prono->setGame(null);
            }
        }

        return $this;
    }

}
