<?php

namespace App\Entity\BetInstinct;

use App\Repository\BetInstinct\nombre2setsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=nombre2setsRepository::class)
 */
class nombre2sets
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Affiche::class, inversedBy="nombre2sets")
     */
    private $affiche;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $nb2set;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $nb3set;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $nb4set;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $nb5set;

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

    public function getNb2set(): ?float
    {
        return $this->nb2set;
    }

    public function setNb2set(?float $nb2set): self
    {
        $this->nb2set = $nb2set;

        return $this;
    }

    public function getNb3set(): ?float
    {
        return $this->nb3set;
    }

    public function setNb3set(?float $nb3set): self
    {
        $this->nb3set = $nb3set;

        return $this;
    }

    public function getNb4set(): ?float
    {
        return $this->nb4set;
    }

    public function setNb4set(?float $nb4set): self
    {
        $this->nb4set = $nb4set;

        return $this;
    }

    public function getNb5set(): ?float
    {
        return $this->nb5set;
    }

    public function setNb5set(?float $nb5set): self
    {
        $this->nb5set = $nb5set;

        return $this;
    }
}
