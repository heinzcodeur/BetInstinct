<?php

namespace App\Entity\BetInstinct;

use App\Repository\BetInstinct\SportRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SportRepository::class)
 */
class Sport
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
     * @ORM\Column(type="string", length=255, columnDefinition="ENUM('individuel','collectif')")
     */
    private $type;

    /**
     * @ORM\OneToMany(targetEntity=Type2choix::class, mappedBy="sport")
     */
    private $type2choix;


    public function __toString()
    {
return $this->name;
    }

    public function __construct()
    {
        $this->type2choix = new ArrayCollection();
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

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection|Type2choix[]
     */
    public function getType2choix(): Collection
    {
        return $this->type2choix;
    }

    public function addType2choix(Type2choix $type2choix): self
    {
        if (!$this->type2choix->contains($type2choix)) {
            $this->type2choix[] = $type2choix;
            $type2choix->setSport($this);
        }

        return $this;
    }

    public function removeType2choix(Type2choix $type2choix): self
    {
        if ($this->type2choix->removeElement($type2choix)) {
            // set the owning side to null (unless already changed)
            if ($type2choix->getSport() === $this) {
                $type2choix->setSport(null);
            }
        }

        return $this;
    }
}
