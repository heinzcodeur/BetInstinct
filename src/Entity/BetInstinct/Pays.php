<?php

namespace App\Entity\BetInstinct;

use App\Entity\BetInstinct\City;
use App\Repository\BetInstinct\PaysRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PaysRepository::class)
 */
class Pays
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
    private $name;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $shortcut;

    /**
     * @ORM\OneToMany(targetEntity=City::class, mappedBy="country")
     */
    private $cities;

    /**
     * @ORM\OneToMany(targetEntity=Athlete::class, mappedBy="pays")
     */
    private $athletes;

    /**
     * @ORM\OneToMany(targetEntity=Athlete::class, mappedBy="Origine")
     */
    private $athletes_origine;

    /**
     * @ORM\OneToOne(targetEntity=City::class, cascade={"persist", "remove"})
     */
    private $capitale;


    public function __construct()
    {
        $this->cities = new ArrayCollection();
        $this->athletes = new ArrayCollection();
        $this->athletes_origine = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->name;
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getShortcut(): ?string
    {
        return $this->shortcut;
    }

    public function setShortcut(?string $shortcut): self
    {
        $this->shortcut = $shortcut;

        return $this;
    }

    /**
     * @return Collection|City[]
     */
    public function getCities(): Collection
    {
        return $this->cities;
    }

    public function addCity(City $city): self
    {
        if (!$this->cities->contains($city)) {
            $this->cities[] = $city;
            $city->setCountry($this);
        }

        return $this;
    }

    public function removeCity(City $city): self
    {
        if ($this->cities->removeElement($city)) {
            // set the owning side to null (unless already changed)
            if ($city->getCountry() === $this) {
                $city->setCountry(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Athlete[]
     */
    public function getAthletes(): Collection
    {
        return $this->athletes;
    }

    public function addAthlete(Athlete $athlete): self
    {
        if (!$this->athletes->contains($athlete)) {
            $this->athletes[] = $athlete;
            $athlete->setPays($this);
        }

        return $this;
    }

    public function removeAthlete(Athlete $athlete): self
    {
        if ($this->athletes->removeElement($athlete)) {
            // set the owning side to null (unless already changed)
            if ($athlete->getPays() === $this) {
                $athlete->setPays(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Athlete[]
     */
    public function getAthletesOrigine(): Collection
    {
        return $this->athletes_origine;
    }

    public function addAthletesOrigine(Athlete $athletesOrigine): self
    {
        if (!$this->athletes_origine->contains($athletesOrigine)) {
            $this->athletes_origine[] = $athletesOrigine;
            $athletesOrigine->setOrigine($this);
        }

        return $this;
    }

    public function removeAthletesOrigine(Athlete $athletesOrigine): self
    {
        if ($this->athletes_origine->removeElement($athletesOrigine)) {
            // set the owning side to null (unless already changed)
            if ($athletesOrigine->getOrigine() === $this) {
                $athletesOrigine->setOrigine(null);
            }
        }

        return $this;
    }

    public function getCapitale(): ?City
    {
        return $this->capitale;
    }

    public function setCapitale(?City $capitale): self
    {
        $this->capitale = $capitale;

        return $this;
    }


}
