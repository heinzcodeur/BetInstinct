<?php

namespace App\Entity\BetInstinct;

use App\Repository\BetInstinct\AfficheRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AfficheRepository::class)
 */
class Affiche
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Tournoi::class, inversedBy="affiches")
     * @ORM\JoinColumn(nullable=false)
     */
    private $tournoi;

    /**
     * @ORM\ManyToOne(targetEntity=Athlete::class, inversedBy="affiches_favori")
     * @ORM\JoinColumn(nullable=false)
     */
    private $favori;

    /**
     * @ORM\ManyToOne(targetEntity=Athlete::class, inversedBy="affiches_challenger")
     * @ORM\JoinColumn(nullable=false)
     */
    private $challenger;

    /**
     * @ORM\Column(type="datetime")
     */
    private $schedule;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $score;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTournoi(): ?Tournoi
    {
        return $this->tournoi;
    }

    public function setTournoi(?Tournoi $tournoi): self
    {
        $this->tournoi = $tournoi;

        return $this;
    }

    public function getFavori(): ?Athlete
    {
        return $this->favori;
    }

    public function setFavori(?Athlete $favori): self
    {
        $this->favori = $favori;

        return $this;
    }

    public function getChallenger(): ?Athlete
    {
        return $this->challenger;
    }

    public function setChallenger(?Athlete $challenger): self
    {
        $this->challenger = $challenger;

        return $this;
    }

    public function getSchedule(): ?\DateTimeInterface
    {
        return $this->schedule;
    }

    public function setSchedule(\DateTimeInterface $schedule): self
    {
        $this->schedule = $schedule;

        return $this;
    }

    public function getScore(): ?string
    {
        return $this->score;
    }

    public function setScore(string $score): self
    {
        $this->score = $score;

        return $this;
    }
}
