<?php

namespace App\Entity\BetInstinct;

use App\Repository\BetInstinct\PariRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PariRepository::class)
 */
class Pari
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Formule::class, inversedBy="paris")
     * @ORM\JoinColumn(nullable=false)
     */
    private $formule;

    /**
     * @ORM\OneToMany(targetEntity=Pronostic::class, mappedBy="pari")
     */
    private $pronostic;

    public function __construct()
    {
        $this->pronostic = new ArrayCollection();
    }


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

    /**
     * @return Collection|Pronostic[]
     */
    public function getPronostic(): Collection
    {
        return $this->pronostic;
    }

    public function addPronostic(Pronostic $pronostic): self
    {
        if (!$this->pronostic->contains($pronostic)) {
            $this->pronostic[] = $pronostic;
            $pronostic->setPari($this);
        }

        return $this;
    }

    public function removePronostic(Pronostic $pronostic): self
    {
        if ($this->pronostic->removeElement($pronostic)) {
            // set the owning side to null (unless already changed)
            if ($pronostic->getPari() === $this) {
                $pronostic->setPari(null);
            }
        }

        return $this;
    }


}
