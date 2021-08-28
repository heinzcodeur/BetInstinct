<?php

namespace App\Entity\BetInstinct;

use App\Repository\BetInstinct\TypoPariRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TypoPariRepository::class)
 */
class TypoPari
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="float")
     */
    private $score_2_0;

    /**
     * @ORM\Column(type="float")
     */
    private $score_2_1;
/**
     * @ORM\Column(type="float")
     */
    private $score_0_2;

    public function __toString()
    {
return $this->nom;    }

    /**
     * @return mixed
     */
    public function getScore02()
    {
        return $this->score_0_2;
    }

    /**
     * @param mixed $score_0_2
     */
    public function setScore02($score_0_2): void
    {
        $this->score_0_2 = $score_0_2;
    }

    /**
     * @return mixed
     */
    public function getScore12()
    {
        return $this->score_1_2;
    }

    /**
     * @param mixed $score_1_2
     */
    public function setScore12($score_1_2): void
    {
        $this->score_1_2 = $score_1_2;
    }
/**
     * @ORM\Column(type="float")
     */
    private $score_1_2;

    /**
     * @ORM\ManyToOne(targetEntity=Affiche::class, inversedBy="typoParis")
     */
    private $affiche;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getScore20(): ?float
    {
        return $this->score_2_0;
    }

    public function setScore20(float $score_2_0): self
    {
        $this->score_2_0 = $score_2_0;

        return $this;
    }

    public function getScore21(): ?float
    {
        return $this->score_2_1;
    }

    public function setScore21(float $score_2_1): self
    {
        $this->score_2_1 = $score_2_1;

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
}
