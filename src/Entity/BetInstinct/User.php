<?php

namespace App\Entity\BetInstinct;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @UniqueEntity(fields={"email"}, message="There is already an account with this email")
 */
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isVerified = false;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $birth_date;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $profession;

    /**
     * @ORM\OneToMany(targetEntity=Transaction::class, mappedBy="auteur")
     */
    private $transactions;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nickname;

    /**
     * @ORM\OneToMany(targetEntity=Pari::class, mappedBy="auteur")
     */
    private $paris;

    /**
     * @ORM\ManyToOne(targetEntity=Bankroll::class, inversedBy="users")
     */
    private $solde;

    /**
     * @ORM\OneToMany(targetEntity=Pronostic::class, mappedBy="author")
     */
    private $pronostics;

    /**
     * @ORM\OneToMany(targetEntity=Jeu::class, mappedBy="parieur")
     */
    private $jeux;

    /**
     * @ORM\OneToMany(targetEntity=Game::class, mappedBy="parieur")
     */
    private $games;

    public function __construct()
    {
        $this->transactions = new ArrayCollection();
        $this->paris = new ArrayCollection();
        $this->pronostics = new ArrayCollection();
        $this->jeux = new ArrayCollection();
        $this->games = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->nickname;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): self
    {
        $this->isVerified = $isVerified;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getBirthDate(): ?\DateTimeInterface
    {
        return $this->birth_date;
    }

    public function setBirthDate(?\DateTimeInterface $birth_date): self
    {
        $this->birth_date = $birth_date;

        return $this;
    }

    public function getProfession(): ?string
    {
        return $this->profession;
    }

    public function setProfession(?string $profession): self
    {
        $this->profession = $profession;

        return $this;
    }

    /**
     * @return Collection|Transaction[]
     */
    public function getTransactions(): Collection
    {
        return $this->transactions;
    }

    public function addTransaction(Transaction $transaction): self
    {
        if (!$this->transactions->contains($transaction)) {
            $this->transactions[] = $transaction;
            $transaction->setAuteur($this);
        }

        return $this;
    }

    public function removeTransaction(Transaction $transaction): self
    {
        if ($this->transactions->removeElement($transaction)) {
            // set the owning side to null (unless already changed)
            if ($transaction->getAuteur() === $this) {
                $transaction->setAuteur(null);
            }
        }

        return $this;
    }

    public function getNickname(): ?string
    {
        return $this->nickname;
    }

    public function setNickname(string $nickname): self
    {
        $this->nickname = $nickname;

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
            $pari->setAuteur($this);
        }

        return $this;
    }

    public function removePari(Pari $pari): self
    {
        if ($this->paris->removeElement($pari)) {
            // set the owning side to null (unless already changed)
            if ($pari->getAuteur() === $this) {
                $pari->setAuteur(null);
            }
        }

        return $this;
    }

    public function getSolde(): ?Bankroll
    {
        return $this->solde;
    }

    public function setSolde(?Bankroll $solde): self
    {
        $this->solde = $solde;

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
            $pronostic->setAuthor($this);
        }

        return $this;
    }

    public function removePronostic(Pronostic $pronostic): self
    {
        if ($this->pronostics->removeElement($pronostic)) {
            // set the owning side to null (unless already changed)
            if ($pronostic->getAuthor() === $this) {
                $pronostic->setAuthor(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Jeu[]
     */
    public function getJeux(): Collection
    {
        return $this->jeux;
    }

    public function addJeux(Jeu $jeux): self
    {
        if (!$this->jeux->contains($jeux)) {
            $this->jeux[] = $jeux;
            $jeux->setParieur($this);
        }

        return $this;
    }

    public function removeJeux(Jeu $jeux): self
    {
        if ($this->jeux->removeElement($jeux)) {
            // set the owning side to null (unless already changed)
            if ($jeux->getParieur() === $this) {
                $jeux->setParieur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Game[]
     */
    public function getGames(): Collection
    {
        return $this->games;
    }

    public function addGame(Game $game): self
    {
        if (!$this->games->contains($game)) {
            $this->games[] = $game;
            $game->setParieur($this);
        }

        return $this;
    }

    public function removeGame(Game $game): self
    {
        if ($this->games->removeElement($game)) {
            // set the owning side to null (unless already changed)
            if ($game->getParieur() === $this) {
                $game->setParieur(null);
            }
        }

        return $this;
    }
}
