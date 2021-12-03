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

    /**
     * @ORM\OneToMany(targetEntity=Association::class, mappedBy="sport")
     */
    private $associations;

    /**
     * @ORM\OneToMany(targetEntity=Equipe::class, mappedBy="sport", orphanRemoval=true)
     */
    private $equipes;

    /**
     * @ORM\OneToMany(targetEntity=Tournoi::class, mappedBy="sport")
     */
    private $tournois;


    public function __toString()
    {
return $this->name;
    }

    public function __construct()
    {
        $this->type2choix = new ArrayCollection();
        $this->associations = new ArrayCollection();
        $this->equipes = new ArrayCollection();
        $this->tournois = new ArrayCollection();
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

    /**
     * @return Collection|Association[]
     */
    public function getAssociations(): Collection
    {
        return $this->associations;
    }

    public function addAssociation(Association $association): self
    {
        if (!$this->associations->contains($association)) {
            $this->associations[] = $association;
            $association->setSport($this);
        }

        return $this;
    }

    public function removeAssociation(Association $association): self
    {
        if ($this->associations->removeElement($association)) {
            // set the owning side to null (unless already changed)
            if ($association->getSport() === $this) {
                $association->setSport(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Equipe[]
     */
    public function getEquipes(): Collection
    {
        return $this->equipes;
    }

    public function addEquipe(Equipe $equipe): self
    {
        if (!$this->equipes->contains($equipe)) {
            $this->equipes[] = $equipe;
            $equipe->setSport($this);
        }

        return $this;
    }

    public function removeEquipe(Equipe $equipe): self
    {
        if ($this->equipes->removeElement($equipe)) {
            // set the owning side to null (unless already changed)
            if ($equipe->getSport() === $this) {
                $equipe->setSport(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Tournoi[]
     */
    public function getTournois(): Collection
    {
        return $this->tournois;
    }

    public function addTournoi(Tournoi $tournoi): self
    {
        if (!$this->tournois->contains($tournoi)) {
            $this->tournois[] = $tournoi;
            $tournoi->setSport($this);
        }

        return $this;
    }

    public function removeTournoi(Tournoi $tournoi): self
    {
        if ($this->tournois->removeElement($tournoi)) {
            // set the owning side to null (unless already changed)
            if ($tournoi->getSport() === $this) {
                $tournoi->setSport(null);
            }
        }

        return $this;
    }
}
