<?php

namespace App\Entity\BetInstinct;

use App\Repository\BetInstinct\Les2joueursWin1setRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=Les2joueursWin1setRepository::class)
 */
class Les2joueursWin1set
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean")
     */
    private $oui;

    /**
     * @ORM\Column(type="boolean")
     */
    private $non;

    /**
     * @ORM\ManyToOne(targetEntity=Affiche::class, inversedBy="les2joueursWin1sets")
     */
    private $affiche;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOui(): ?bool
    {
        return $this->oui;
    }

    public function setOui(bool $oui): self
    {
        $this->oui = $oui;

        return $this;
    }

    public function getNon(): ?bool
    {
        return $this->non;
    }

    public function setNon(bool $non): self
    {
        $this->non = $non;

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
