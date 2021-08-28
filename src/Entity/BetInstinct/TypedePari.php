<?php

namespace App\Entity\BetInstinct;

use App\Repository\BetInstinct\TypedePariRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TypedePariRepository::class)
 */
class TypedePari
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Type2choix::class, inversedBy="typedeParis")
     */
    private $type2choix;

    /**
     * @ORM\OneToMany(targetEntity=Bet::class, mappedBy="TypedePari")
     */
    private $bets;

    public function __toString()
    {
return $this->type2choix->getName();
    }

    public function __construct()
    {
        $this->bets = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType2choix(): ?Type2choix
    {
        return $this->type2choix;
    }

    public function setType2choix(?Type2choix $type2choix): self
    {
        $this->type2choix = $type2choix;

        return $this;
    }

    /**
     * @return Collection|Bet[]
     */
    public function getBets(): Collection
    {
        return $this->bets;
    }

    public function addBet(Bet $bet): self
    {
        if (!$this->bets->contains($bet)) {
            $this->bets[] = $bet;
            $bet->setTypedePari($this);
        }

        return $this;
    }

    public function removeBet(Bet $bet): self
    {
        if ($this->bets->removeElement($bet)) {
            // set the owning side to null (unless already changed)
            if ($bet->getTypedePari() === $this) {
                $bet->setTypedePari(null);
            }
        }

        return $this;
    }
}
