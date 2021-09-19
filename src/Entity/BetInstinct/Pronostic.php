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
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="pronostics")
     * @ORM\JoinColumn(nullable=false)
     */
    private $author;

    /**
     * @ORM\OneToOne(targetEntity=Jeu::class, mappedBy="pronostic2", cascade={"persist", "remove"})
     */
    private $jeu2;

    /**
     * @ORM\OneToOne(targetEntity=Jeu::class, mappedBy="pronostic3", cascade={"persist", "remove"})
     */
    private $jeu3;

    /**
     * @ORM\ManyToOne(targetEntity=Jeu::class, inversedBy="prono")
     */
    private $game;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isValid;

    /**
     * @ORM\ManyToOne(targetEntity=Affiche::class, inversedBy="pronostics")
     */
    private $affiche;

    /**
     * @ORM\ManyToOne(targetEntity=Game::class, inversedBy="pronostics")
     * @ORM\JoinColumn(nullable=false)
     */
    private $game1;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $created;


    public function __toString()
    {
        return $this->getChoix();
    }

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


    public function getAuthor(): ?User
    {
        return $this->author;
    }

    public function setAuthor(?User $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getJeu2(): ?Jeu
    {
        return $this->jeu2;
    }

    public function setJeu2(?Jeu $jeu2): self
    {
        // unset the owning side of the relation if necessary
        if ($jeu2 === null && $this->jeu2 !== null) {
            $this->jeu2->setPronostic2(null);
        }

        // set the owning side of the relation if necessary
        if ($jeu2 !== null && $jeu2->getPronostic2() !== $this) {
            $jeu2->setPronostic2($this);
        }

        $this->jeu2 = $jeu2;

        return $this;
    }

    public function getJeu3(): ?Jeu
    {
        return $this->jeu3;
    }

    public function setJeu3(?Jeu $jeu3): self
    {
        // unset the owning side of the relation if necessary
        if ($jeu3 === null && $this->jeu3 !== null) {
            $this->jeu3->setPronostic3(null);
        }

        // set the owning side of the relation if necessary
        if ($jeu3 !== null && $jeu3->getPronostic3() !== $this) {
            $jeu3->setPronostic3($this);
        }

        $this->jeu3 = $jeu3;

        return $this;
    }

    public function getGame(): ?Jeu
    {
        return $this->game;
    }

    public function setGame(?Jeu $game): self
    {
        $this->game = $game;

        return $this;
    }

    public function getIsValid(): ?bool
    {
        return $this->isValid;
    }

    public function setIsValid(?bool $isValid): self
    {
        $this->isValid = $isValid;

        return $this;
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

    public function getGame1(): ?Game
    {
        return $this->game1;
    }

    public function setGame1(?Game $game1): self
    {
        $this->game1 = $game1;

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


}
