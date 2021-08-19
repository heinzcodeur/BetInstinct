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
     * @ORM\ManyToOne(targetEntity=Pari::class, inversedBy="pronostics")
     */
    private $pari;

    public function getId(): ?int
    {
        return $this->id;
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
