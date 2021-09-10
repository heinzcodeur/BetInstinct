<?php

namespace App\Entity\BetInstinct;

use App\Repository\BetInstinct\PariRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PariRepository::class)
 */
class Pari
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Formule::class, inversedBy="paris")
     * @ORM\JoinColumn(nullable=false)
     */
    private $formule;

    /**
     * @ORM\OneToMany(targetEntity=Pronostic::class, mappedBy="pari")
     */
    private $pronostic;

    /**
     * @ORM\ManyToOne(targetEntity=Bet::class, inversedBy="paris")
     * @ORM\JoinColumn(nullable=false)
     */
    private $bet;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="paris")
     * @ORM\JoinColumn(nullable=false)
     */
    private $auteur;

    /**
     * @ORM\ManyToOne(targetEntity=Transaction::class, inversedBy="paris")
     */
    private $mise;

    public function __construct()
    {
        $this->pronostic = new ArrayCollection();
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


    public function getBet(): ?Bet
    {
        return $this->bet;
    }

    public function setBet(?Bet $bet): self
    {
        $this->bet = $bet;

        return $this;
    }

    public function getAuteur(): ?User
    {
        return $this->auteur;
    }

    public function setAuteur(?User $auteur): self
    {
        $this->auteur = $auteur;

        return $this;
    }

    public function getMise(): ?Transaction
    {
        return $this->mise;
    }

    public function setMise(?Transaction $mise): self
    {
        $this->mise = $mise;

        return $this;
    }


}
