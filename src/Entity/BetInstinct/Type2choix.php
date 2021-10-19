<?php

namespace App\Entity\BetInstinct;

use App\Repository\BetInstinct\Type2choixRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=Type2choixRepository::class)
 */
class Type2choix
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
    private $choix1;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $choix2;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $choix3;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $choix4;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $choix5;
/**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $choix6;


    public function __toString()
    {
return $this->name;
    }

    /**
     * @return mixed
     */
    public function getChoix6()
    {
        return $this->choix6;
    }

    /**
     * @param mixed $choix6
     */
    public function setChoix6($choix6): void
    {
        $this->choix6 = $choix6;
    }

    /**
     * @return mixed
     */
    public function getChoix7()
    {
        return $this->choix7;
    }

    /**
     * @param mixed $choix7
     */
    public function setChoix7($choix7): void
    {
        $this->choix7 = $choix7;
    }

    /**
     * @return mixed
     */
    public function getChoix8()
    {
        return $this->choix8;
    }

    /**
     * @param mixed $choix8
     */
    public function setChoix8($choix8): void
    {
        $this->choix8 = $choix8;
    }

    /**
     * @return mixed
     */
    public function getChoix9()
    {
        return $this->choix9;
    }

    /**
     * @param mixed $choix9
     */
    public function setChoix9($choix9): void
    {
        $this->choix9 = $choix9;
    }

    /**
     * @return mixed
     */
    public function getChoix10()
    {
        return $this->choix10;
    }

    /**
     * @param mixed $choix10
     */
    public function setChoix10($choix10): void
    {
        $this->choix10 = $choix10;
    }

    /**
     * @return mixed
     */
    public function getChoix11()
    {
        return $this->choix11;
    }

    /**
     * @param mixed $choix11
     */
    public function setChoix11($choix11): void
    {
        $this->choix11 = $choix11;
    }

    /**
     * @return mixed
     */
    public function getChoix12()
    {
        return $this->choix12;
    }

    /**
     * @param mixed $choix12
     */
    public function setChoix12($choix12): void
    {
        $this->choix12 = $choix12;
    }

    /**
     * @return mixed
     */
    public function getChoix13()
    {
        return $this->choix13;
    }

    /**
     * @param mixed $choix13
     */
    public function setChoix13($choix13): void
    {
        $this->choix13 = $choix13;
    }

    /**
     * @return mixed
     */
    public function getChoix14()
    {
        return $this->choix14;
    }

    /**
     * @param mixed $choix14
     */
    public function setChoix14($choix14): void
    {
        $this->choix14 = $choix14;
    }

    /**
     * @return mixed
     */
    public function getChoix15()
    {
        return $this->choix15;
    }

    /**
     * @param mixed $choix15
     */
    public function setChoix15($choix15): void
    {
        $this->choix15 = $choix15;
    }

    /**
     * @return mixed
     */
    public function getChoix16()
    {
        return $this->choix16;
    }

    /**
     * @param mixed $choix16
     */
    public function setChoix16($choix16): void
    {
        $this->choix16 = $choix16;
    }

    /**
     * @return mixed
     */
    public function getChoix17()
    {
        return $this->choix17;
    }

    /**
     * @param mixed $choix17
     */
    public function setChoix17($choix17): void
    {
        $this->choix17 = $choix17;
    }

    /**
     * @return mixed
     */
    public function getChoix18()
    {
        return $this->choix18;
    }

    /**
     * @param mixed $choix18
     */
    public function setChoix18($choix18): void
    {
        $this->choix18 = $choix18;
    }

    /**
     * @return mixed
     */
    public function getChoix19()
    {
        return $this->choix19;
    }

    /**
     * @param mixed $choix19
     */
    public function setChoix19($choix19): void
    {
        $this->choix19 = $choix19;
    }
/**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $choix7;
/**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $choix8;
/**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $choix9;
/**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $choix10;
/**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $choix11;
/**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $choix12;
/**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $choix13;
/**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $choix14;
/**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $choix15;
/**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $choix16;
/**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $choix17;
/**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $choix18;
/**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $choix19;
/**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $choix20;

    /**
     * @return mixed
     */
    public function getChoix20()
    {
        return $this->choix20;
    }

    /**
     * @param mixed $choix20
     */
    public function setChoix20($choix20): void
    {
        $this->choix20 = $choix20;
    }

    /**
     * @ORM\OneToMany(targetEntity=TypedePari::class, mappedBy="type2choix")
     */
    private $typedeParis;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity=Sport::class, inversedBy="type2choix")
     */
    private $sport;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $choix21;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $choix22;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $choix23;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $choix24;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $choix25;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $choix26;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $choix27;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $choix28;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $choix29;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $choix30;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $choix31;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $choix32;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $choix33;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $choix34;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $choix35;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $choix36;

    public function __construct()
    {
        $this->typedeParis = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getChoix1(): ?string
    {
        return $this->choix1;
    }

    public function setChoix1(?string $choix1): self
    {
        $this->choix1 = $choix1;

        return $this;
    }

    public function getChoix2(): ?string
    {
        return $this->choix2;
    }

    public function setChoix2(?string $choix2): self
    {
        $this->choix2 = $choix2;

        return $this;
    }

    public function getChoix3(): ?string
    {
        return $this->choix3;
    }

    public function setChoix3(?string $choix3): self
    {
        $this->choix3 = $choix3;

        return $this;
    }

    public function getChoix4(): ?string
    {
        return $this->choix4;
    }

    public function setChoix4(?string $choix4): self
    {
        $this->choix4 = $choix4;

        return $this;
    }

    public function getChoix5(): ?string
    {
        return $this->choix5;
    }

    public function setChoix5(?string $choix5): self
    {
        $this->choix5 = $choix5;

        return $this;
    }

    /**
     * @return Collection|TypedePari[]
     */
    public function getTypedeParis(): Collection
    {
        return $this->typedeParis;
    }

    public function addTypedePari(TypedePari $typedePari): self
    {
        if (!$this->typedeParis->contains($typedePari)) {
            $this->typedeParis[] = $typedePari;
            $typedePari->setType2choix($this);
        }

        return $this;
    }

    public function removeTypedePari(TypedePari $typedePari): self
    {
        if ($this->typedeParis->removeElement($typedePari)) {
            // set the owning side to null (unless already changed)
            if ($typedePari->getType2choix() === $this) {
                $typedePari->setType2choix(null);
            }
        }

        return $this;
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

    public function getSport(): ?Sport
    {
        return $this->sport;
    }

    public function setSport(?Sport $sport): self
    {
        $this->sport = $sport;

        return $this;
    }

    public function getChoix21(): ?string
    {
        return $this->choix21;
    }

    public function setChoix21(?string $choix21): self
    {
        $this->choix21 = $choix21;

        return $this;
    }

    public function getChoix22(): ?string
    {
        return $this->choix22;
    }

    public function setChoix22(?string $choix22): self
    {
        $this->choix22 = $choix22;

        return $this;
    }

    public function getChoix23(): ?string
    {
        return $this->choix23;
    }

    public function setChoix23(?string $choix23): self
    {
        $this->choix23 = $choix23;

        return $this;
    }

    public function getChoix24(): ?string
    {
        return $this->choix24;
    }

    public function setChoix24(?string $choix24): self
    {
        $this->choix24 = $choix24;

        return $this;
    }

    public function getChoix25(): ?string
    {
        return $this->choix25;
    }

    public function setChoix25(?string $choix25): self
    {
        $this->choix25 = $choix25;

        return $this;
    }

    public function getChoix26(): ?string
    {
        return $this->choix26;
    }

    public function setChoix26(?string $choix26): self
    {
        $this->choix26 = $choix26;

        return $this;
    }

    public function getChoix27(): ?string
    {
        return $this->choix27;
    }

    public function setChoix27(?string $choix27): self
    {
        $this->choix27 = $choix27;

        return $this;
    }

    public function getChoix28(): ?string
    {
        return $this->choix28;
    }

    public function setChoix28(?string $choix28): self
    {
        $this->choix28 = $choix28;

        return $this;
    }

    public function getChoix29(): ?string
    {
        return $this->choix29;
    }

    public function setChoix29(?string $choix29): self
    {
        $this->choix29 = $choix29;

        return $this;
    }

    public function getChoix30(): ?string
    {
        return $this->choix30;
    }

    public function setChoix30(?string $choix30): self
    {
        $this->choix30 = $choix30;

        return $this;
    }

    public function getChoix31(): ?string
    {
        return $this->choix31;
    }

    public function setChoix31(?string $choix31): self
    {
        $this->choix31 = $choix31;

        return $this;
    }

    public function getChoix32(): ?string
    {
        return $this->choix32;
    }

    public function setChoix32(?string $choix32): self
    {
        $this->choix32 = $choix32;

        return $this;
    }

    public function getChoix33(): ?string
    {
        return $this->choix33;
    }

    public function setChoix33(?string $choix33): self
    {
        $this->choix33 = $choix33;

        return $this;
    }

    public function getChoix34(): ?string
    {
        return $this->choix34;
    }

    public function setChoix34(?string $choix34): self
    {
        $this->choix34 = $choix34;

        return $this;
    }

    public function getChoix35(): ?string
    {
        return $this->choix35;
    }

    public function setChoix35(?string $choix35): self
    {
        $this->choix35 = $choix35;

        return $this;
    }

    public function getChoix36(): ?string
    {
        return $this->choix36;
    }

    public function setChoix36(?string $choix36): self
    {
        $this->choix36 = $choix36;

        return $this;
    }
}
