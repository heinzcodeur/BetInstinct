<?php

namespace App\Entity\BetInstinct;

use App\Repository\BetInstinct\TypePariRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TypePariRepository::class)
 */
class TypePari
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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="array")
     */
    private $cotes = [];

    /**
     * @ORM\OneToMany(targetEntity=Pari::class, mappedBy="type")
     */
    private $paris;

    public function __construct()
    {
        $this->paris = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCotes(): ?array
    {
        return $this->cotes;
    }

    public function setCotes(array $cotes): self
    {
        $this->cotes = $cotes;

        return $this;
    }

    /**
     * @return Collection|Pari[]
     */
    public function getParis(): Collection
    {
        return $this->paris;
    }

    public function addPari(Pari $pari): self
    {
        if (!$this->paris->contains($pari)) {
            $this->paris[] = $pari;
            $pari->setType($this);
        }

        return $this;
    }

    public function removePari(Pari $pari): self
    {
        if ($this->paris->removeElement($pari)) {
            // set the owning side to null (unless already changed)
            if ($pari->getType() === $this) {
                $pari->setType(null);
            }
        }

        return $this;
    }
}
