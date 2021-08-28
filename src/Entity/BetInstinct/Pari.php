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
     * @ORM\ManyToOne(targetEntity=Affiche::class, inversedBy="paris")
     * @ORM\JoinColumn(nullable=false)
     */
    private $affiche;

    /**
     * @ORM\ManyToOne(targetEntity=TypePari::class, inversedBy="paris")
     * @ORM\JoinColumn(nullable=false)
     */
    private $type;

    /**
     * @ORM\OneToMany(targetEntity=Pronostic::class, mappedBy="pari")
     */
    private $pronostics;

    /**
     * @ORM\OneToMany(targetEntity=Choix::class, mappedBy="pari")
     */
    private $choix;

    public function __construct()
    {
        $this->pronostics = new ArrayCollection();
        $this->choix = new ArrayCollection();
    }

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

    public function getType(): ?TypePari
    {
        return $this->type;
    }

    public function setType(?TypePari $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection|Pronostic[]
     */
    public function getPronostics(): Collection
    {
        return $this->pronostics;
    }

    public function addPronostic(Pronostic $pronostic): self
    {
        if (!$this->pronostics->contains($pronostic)) {
            $this->pronostics[] = $pronostic;
            $pronostic->setPari($this);
        }

        return $this;
    }

    public function removePronostic(Pronostic $pronostic): self
    {
        if ($this->pronostics->removeElement($pronostic)) {
            // set the owning side to null (unless already changed)
            if ($pronostic->getPari() === $this) {
                $pronostic->setPari(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Choix[]
     */
    public function getChoix(): Collection
    {
        return $this->choix;
    }

    public function addChoix(Choix $choix): self
    {
        if (!$this->choix->contains($choix)) {
            $this->choix[] = $choix;
            $choix->setPari($this);
        }

        return $this;
    }

    public function removeChoix(Choix $choix): self
    {
        if ($this->choix->removeElement($choix)) {
            // set the owning side to null (unless already changed)
            if ($choix->getPari() === $this) {
                $choix->setPari(null);
            }
        }

        return $this;
    }
}
