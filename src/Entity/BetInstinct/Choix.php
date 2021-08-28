<?php

namespace App\Entity\BetInstinct;

use App\Repository\BetInstinct\ChoixRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ChoixRepository::class)
 */
class Choix
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=TypePari::class, inversedBy="choixes")
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $choix1;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $choix2;

    /**
     * @ORM\ManyToOne(targetEntity=Pari::class, inversedBy="choix")
     */
    private $pari;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function __toString()
    {
return $this->choix1;
    }

    public function getName(): ?TypePari
    {
        return $this->name;
    }

    public function setName(?TypePari $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getChoix1(): ?string
    {
        return $this->choix1;
    }

    public function setChoix1(string $choix1): self
    {
        $this->choix1 = $choix1;

        return $this;
    }

    public function getChoix2(): ?string
    {
        return $this->choix2;
    }

    public function setChoix2(string $choix2): self
    {
        $this->choix2 = $choix2;

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
