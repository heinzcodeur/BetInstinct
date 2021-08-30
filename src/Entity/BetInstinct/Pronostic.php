<?php

namespace App\Entity\BetInstinct;

use App\Repository\BetInstinct\PronosticRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PronosticRepository::class)
 */
class Pronostic
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;


    /**
     * @ORM\ManyToOne(targetEntity=Bet::class, inversedBy="pronostics")
     * @ORM\JoinColumn(nullable=false)
     */
    private $bet;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $choix;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $cote;

    /**
     * @ORM\ManyToOne(targetEntity=Pari::class, inversedBy="pronostic")
     */
    private $pari;


    public function getId(): ?int
    {
        return $this->id;
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

    public function getChoix(): ?string
    {
        return $this->choix;
    }

    public function setChoix(?string $choix): self
    {
        $this->choix = $choix;

        return $this;
    }

    public function getCote(): ?float
    {
        return $this->cote;
    }

    public function setCote(?float $cote): self
    {
        $this->cote = $cote;

        return $this;
    }

    public function getPari(): ?Pari
    {
        return $this->pari;
    }

    public function setPari(?Pari $pari): self
    {
        $this->pari = $pari;

        return $this;
    }

}
