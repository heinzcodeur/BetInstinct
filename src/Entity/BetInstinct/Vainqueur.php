<?php

namespace App\Entity\BetInstinct;

use App\Repository\BetInstinct\VainqueurRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VainqueurRepository::class)
 */
class Vainqueur
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $favori;

    /**
     * @ORM\Column(type="float")
     */
    private $outsider;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity=Affiche::class, inversedBy="vainqueurs")
     */
    private $affiche;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFavori(): ?float
    {
        return $this->favori;
    }

    public function setFavori(float $favori): self
    {
        $this->favori = $favori;

        return $this;
    }

    public function getOutsider(): ?float
    {
        return $this->outsider;
    }

    public function setOutsider(float $outsider): self
    {
        $this->outsider = $outsider;

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
