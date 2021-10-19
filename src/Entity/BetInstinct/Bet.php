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

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $cote15;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $cote16;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $cote17;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $cote18;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $cote19;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $cote20;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $cote21;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $cote22;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $cote23;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $cote24;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $cote25;

    /**
     * @ORM\Column(type="float", length=255, nullable=true)
     */
    private $cote26;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $cote27;

    /**
     * @ORM\Column(type="float", length=255, nullable=true)
     */
    private $cote28;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $cote29;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $cote30;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $cote31;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $cote32;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $cote33;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $cote34;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $cote35;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $cote36;

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

    public function getCote15(): ?float
    {
        return $this->cote15;
    }

    public function setCote15(?float $cote15): self
    {
        $this->cote15 = $cote15;

        return $this;
    }

    public function getCote16(): ?float
    {
        return $this->cote16;
    }

    public function setCote16(?float $cote16): self
    {
        $this->cote16 = $cote16;

        return $this;
    }

    public function getCote17(): ?float
    {
        return $this->cote17;
    }

    public function setCote17(?float $cote17): self
    {
        $this->cote17 = $cote17;

        return $this;
    }

    public function getCote18(): ?float
    {
        return $this->cote18;
    }

    public function setCote18(?float $cote18): self
    {
        $this->cote18 = $cote18;

        return $this;
    }

    public function getCote19(): ?float
    {
        return $this->cote19;
    }

    public function setCote19(?float $cote19): self
    {
        $this->cote19 = $cote19;

        return $this;
    }

    public function getCote20(): ?float
    {
        return $this->cote20;
    }

    public function setCote20(?float $cote20): self
    {
        $this->cote20 = $cote20;

        return $this;
    }

    public function getCote21(): ?float
    {
        return $this->cote21;
    }

    public function setCote21(?float $cote21): self
    {
        $this->cote21 = $cote21;

        return $this;
    }

    public function getCote22(): ?float
    {
        return $this->cote22;
    }

    public function setCote22(?float $cote22): self
    {
        $this->cote22 = $cote22;

        return $this;
    }

    public function getCote23(): ?float
    {
        return $this->cote23;
    }

    public function setCote23(?float $cote23): self
    {
        $this->cote23 = $cote23;

        return $this;
    }

    public function getCote24(): ?float
    {
        return $this->cote24;
    }

    public function setCote24(?float $cote24): self
    {
        $this->cote24 = $cote24;

        return $this;
    }

    public function getCote25(): ?float
    {
        return $this->cote25;
    }

    public function setCote25(?float $cote25): self
    {
        $this->cote25 = $cote25;

        return $this;
    }

    public function getCote26(): ?string
    {
        return $this->cote26;
    }

    public function setCote26(?string $cote26): self
    {
        $this->cote26 = $cote26;

        return $this;
    }

    public function getCote27(): ?float
    {
        return $this->cote27;
    }

    public function setCote27(?float $cote27): self
    {
        $this->cote27 = $cote27;

        return $this;
    }

    public function getCote28(): ?string
    {
        return $this->cote28;
    }

    public function setCote28(?string $cote28): self
    {
        $this->cote28 = $cote28;

        return $this;
    }

    public function getCote29(): ?float
    {
        return $this->cote29;
    }

    public function setCote29(?float $cote29): self
    {
        $this->cote29 = $cote29;

        return $this;
    }

    public function getCote30(): ?string
    {
        return $this->cote30;
    }

    public function setCote30(string $cote30): self
    {
        $this->cote30 = $cote30;

        return $this;
    }

    public function getCote31(): ?float
    {
        return $this->cote31;
    }

    public function setCote31(?float $cote31): self
    {
        $this->cote31 = $cote31;

        return $this;
    }

    public function getCote32(): ?float
    {
        return $this->cote32;
    }

    public function setCote32(?float $cote32): self
    {
        $this->cote32 = $cote32;

        return $this;
    }

    public function getCote33(): ?float
    {
        return $this->cote33;
    }

    public function setCote33(?float $cote33): self
    {
        $this->cote33 = $cote33;

        return $this;
    }

    public function getCote34(): ?float
    {
        return $this->cote34;
    }

    public function setCote34(?float $cote34): self
    {
        $this->cote34 = $cote34;

        return $this;
    }

    public function getCote35(): ?float
    {
        return $this->cote35;
    }

    public function setCote35(?float $cote35): self
    {
        $this->cote35 = $cote35;

        return $this;
    }

    public function getCote36(): ?float
    {
        return $this->cote36;
    }

    public function setCote36(?float $cote36): self
    {
        $this->cote36 = $cote36;

        return $this;
    }
}
