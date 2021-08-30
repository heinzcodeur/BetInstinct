<?php

namespace App\Entity\BetInstinct;

use App\Repository\BetInstinct\BetRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $cote1;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $cote2;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $cote3;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $cote4;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $cote5;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $cote6;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $cote7;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $cote8;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $cote9;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $cote10;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $cote11;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $cote12;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $cote13;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $cote14;

    /**
     * @ORM\OneToMany(targetEntity=Pronostic::class, mappedBy="bet")
     */
    private $pronostics;

    public function __toString()
    {
return (string)$this->TypedePari;
    }


    public function __construct()
    {
        $this->pronostics = new ArrayCollection();
    }

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

    public function getCote1(): ?float
    {
        return $this->cote1;
    }

    public function setCote1(?float $cote1): self
    {
        $this->cote1 = $cote1;

        return $this;
    }

    public function getCote2(): ?float
    {
        return $this->cote2;
    }

    public function setCote2(?float $cote2): self
    {
        $this->cote2 = $cote2;

        return $this;
    }

    public function getCote3(): ?float
    {
        return $this->cote3;
    }

    public function setCote3(?float $cote3): self
    {
        $this->cote3 = $cote3;

        return $this;
    }

    public function getCote4(): ?float
    {
        return $this->cote4;
    }

    public function setCote4(?float $cote4): self
    {
        $this->cote4 = $cote4;

        return $this;
    }

    public function getCote5(): ?float
    {
        return $this->cote5;
    }

    public function setCote5(?float $cote5): self
    {
        $this->cote5 = $cote5;

        return $this;
    }

    public function getCote6(): ?float
    {
        return $this->cote6;
    }

    public function setCote6(?float $cote6): self
    {
        $this->cote6 = $cote6;

        return $this;
    }

    public function getCote7(): ?float
    {
        return $this->cote7;
    }

    public function setCote7(?float $cote7): self
    {
        $this->cote7 = $cote7;

        return $this;
    }

    public function getCote8(): ?float
    {
        return $this->cote8;
    }

    public function setCote8(?float $cote8): self
    {
        $this->cote8 = $cote8;

        return $this;
    }

    public function getCote9(): ?float
    {
        return $this->cote9;
    }

    public function setCote9(?float $cote9): self
    {
        $this->cote9 = $cote9;

        return $this;
    }

    public function getCote10(): ?float
    {
        return $this->cote10;
    }

    public function setCote10(?float $cote10): self
    {
        $this->cote10 = $cote10;

        return $this;
    }

    public function getCote11(): ?float
    {
        return $this->cote11;
    }

    public function setCote11(?float $cote11): self
    {
        $this->cote11 = $cote11;

        return $this;
    }

    public function getCote12(): ?float
    {
        return $this->cote12;
    }

    public function setCote12(?float $cote12): self
    {
        $this->cote12 = $cote12;

        return $this;
    }

    public function getCote13(): ?float
    {
        return $this->cote13;
    }

    public function setCote13(?float $cote13): self
    {
        $this->cote13 = $cote13;

        return $this;
    }

    public function getCote14(): ?float
    {
        return $this->cote14;
    }

    public function setCote14(?float $cote14): self
    {
        $this->cote14 = $cote14;

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
            $pronostic->setBet($this);
        }

        return $this;
    }

    public function removePronostic(Pronostic $pronostic): self
    {
        if ($this->pronostics->removeElement($pronostic)) {
            // set the owning side to null (unless already changed)
            if ($pronostic->getBet() === $this) {
                $pronostic->setBet(null);
            }
        }

        return $this;
    }
}
