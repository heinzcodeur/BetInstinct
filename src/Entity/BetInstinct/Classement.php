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
     * @ORM\OneToOne(targetEntity=Athlete::class, mappedBy="ranking")
     */
    private $joueurs;

    /**
     * @ORM\ManyToOne(targetEntity=Association::class, inversedBy="classements")
     * @ORM\JoinColumn(nullable=false)
     */
    private $association;

    public function __construct()
    {
        $this->joueurs = new ArrayCollection();
    }

    public function __toString()
    {
        return (string)$this->ranking.' '.$this->association->getName();
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

    /**
     * @return Collection|Athlete[]
     */
    public function getJoueurs(): Collection
    {
        return $this->joueurs;
    }

    public function addJoueur(Athlete $joueur): self
    {
        if (!$this->joueurs->contains($joueur)) {
            $this->joueurs[] = $joueur;
            $joueur->setRanking($this);
        }

        return $this;
    }

    public function removeJoueur(Athlete $joueur): self
    {
        if ($this->joueurs->removeElement($joueur)) {
            // set the owning side to null (unless already changed)
            if ($joueur->getRanking() === $this) {
                $joueur->setRanking(null);
            }
        }

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
}
