<?php

namespace App\Entity\BetInstinct;

use App\Entity\BetInstinct\Athlete;
use App\Repository\DocumentRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DocumentRepository::class)
 */
class Document
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Athlete::class, inversedBy="documents")
     */
    private $athete;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nom_document;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $file;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $filename;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAthete(): ?Athlete
    {
        return $this->athete;
    }

    public function setAthete(?Athlete $athete): self
    {
        $this->athete = $athete;

        return $this;
    }

    public function getNomDocument(): ?string
    {
        return $this->nom_document;
    }

    public function setNomDocument(?string $nom_document): self
    {
        $this->nom_document = $nom_document;

        return $this;
    }

    public function getFile(): ?string
    {
        return $this->file;
    }

    public function setFile(?string $file): self
    {
        $this->file = $file;

        return $this;
    }

    public function getFilename(): ?string
    {
        return $this->filename;
    }

    public function setFilename(?string $filename): self
    {
        $this->filename = $filename;

        return $this;
    }
}
