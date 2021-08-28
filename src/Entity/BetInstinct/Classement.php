<?php

namespace App\Entity\BetInstinct;

use App\Repository\BetInstinct\ClassementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ClassementRepository::class)
 */
class Classement
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $ranking;


    /**
     * @ORM\ManyToOne(targetEntity=Association::class, inversedBy="classements")
     * @ORM\JoinColumn(nullable=false)
     */
    private $association;

    /**
     * @ORM\OneToOne(targetEntity=Athlete::class, mappedBy="ranking", cascade={"persist", "remove"})
     */
    private $joueur;


    public function __toString()
    {
        return (string)$this->ranking.$this->association;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRanking(): ?int
    {
        return $this->ranking;
    }

    public function setRanking(int $ranking): self
    {
        $this->ranking = $ranking;

        return $this;
    }

    
    public function getAssociation(): ?Association
    {
        return $this->association;
    }

    public function setAssociation(?Association $association): self
    {
        $this->association = $association;

        return $this;
    }

    public function getJoueur(): ?Athlete
    {
        return $this->joueur;
    }

    public function setJoueur(?Athlete $joueur): self
    {
        // unset the owning side of the relation if necessary
        if ($joueur === null && $this->joueur !== null) {
            $this->joueur->setRanking(null);
        }

        // set the owning side of the relation if necessary
        if ($joueur !== null && $joueur->getRanking() !== $this) {
            $joueur->setRanking($this);
        }

        $this->joueur = $joueur;

        return $this;
    }

}
