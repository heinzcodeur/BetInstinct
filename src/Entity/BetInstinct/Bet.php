<?php

namespace App\Entity\BetInstinct;

use App\Repository\BetInstinct\BetRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BetRepository::class)
 */
class Bet
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;


    /**
     * @ORM\ManyToOne(targetEntity=Affiche::class, inversedBy="bet")
     */
    private $affiche;

    /**
     * @ORM\ManyToOne(targetEntity=TypedePari::class, inversedBy="bets")
     */
    private $TypedePari;

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getAffiche(): ?Affiche
    {
        return $this->affiche;
    }

    public function setAffiche(?Affiche $affiche): self
    {
        $this->affiche = $affiche;

        return $this;
    }

    public function getTypedePari(): ?TypedePari
    {
        return $this->TypedePari;
    }

    public function setTypedePari(?TypedePari $TypedePari): self
    {
        $this->TypedePari = $TypedePari;

        return $this;
    }
}
