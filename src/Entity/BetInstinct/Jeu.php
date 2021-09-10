<?php

namespace App\Entity\BetInstinct;

use App\Repository\BetInstinct\JeuRepository;
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
}
