<?php

namespace App\Entity\BetInstinct;

use App\Repository\BetInstinct\PronosticRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isValid;

    /**
     * @ORM\ManyToOne(targetEntity=Affiche::class, inversedBy="pronostics")
     */
    private $affiche;

    /**
     * @ORM\ManyToOne(targetEntity=Game::class, inversedBy="pronostics")
     * @ORM\JoinColumn(nullable=true)
     */
    private $game1;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $created;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $archived;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updated;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isConfirm;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isChecked;

    /**
     * @ORM\ManyToMany(targetEntity=Game::class, inversedBy="pronostics2")
     */
    private $game2;

    /**
     * @ORM\ManyToMany(targetEntity=Game::class, mappedBy="pronos")
     */
    private $game3;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $pronoExact;

    public function __construct()
    {
        $this->game2 = new ArrayCollection();
        $this->game3 = new ArrayCollection();
    }


    public function __toString()
    {
        return (string)$this->affiche.' '.$this->bet->getTypedePari().' '.$this->choix;
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

    public function getArchived(): ?bool
    {
        return $this->archived;
    }

    public function setArchived(?bool $archived): self
    {
        $this->archived = $archived;

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

    public function getIsConfirm(): ?bool
    {
        return $this->isConfirm;
    }

    public function setIsConfirm(?bool $isConfirm): self
    {
        $this->isConfirm = $isConfirm;

        return $this;
    }

    public function getIsChecked(): ?bool
    {
        return $this->isChecked;
    }

    public function setIsChecked(?bool $isChecked): self
    {
        $this->isChecked = $isChecked;

        return $this;
    }

    /**
     * @return Collection|Game[]
     */
    public function getGame2(): Collection
    {
        return $this->game2;
    }

    public function addGame2(Game $game2): self
    {
        if (!$this->game2->contains($game2)) {
            $this->game2[] = $game2;
        }

        return $this;
    }

    public function removeGame2(Game $game2): self
    {
        $this->game2->removeElement($game2);

        return $this;
    }

    /**
     * @return Collection|Game[]
     */
    public function getGame3(): Collection
    {
        return $this->game3;
    }

    public function addGame3(Game $game3): self
    {
        if (!$this->game3->contains($game3)) {
            $this->game3[] = $game3;
            $game3->addProno($this);
        }

        return $this;
    }

    public function removeGame3(Game $game3): self
    {
        if ($this->game3->removeElement($game3)) {
            $game3->removeProno($this);
        }

        return $this;
    }

    public function getPronoExact(): ?string
    {
        return $this->pronoExact;
    }

    public function setPronoExact(?string $pronoExact): self
    {
        $this->pronoExact = $pronoExact;

        return $this;
    }


}
