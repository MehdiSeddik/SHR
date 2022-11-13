<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\AccountRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AccountRepository::class)]
#[ApiResource]
class Account
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'accounts')]
    #[ORM\JoinColumn(nullable: false)]
    private ?AccountType $accountType = null;

    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'accounts')]
    private Collection $accountUser;

    #[ORM\Column(length: 255)]
    private ?string $token = null;

    public function __construct()
    {
        $this->accountUser = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAccountType(): ?AccountType
    {
        return $this->accountType;
    }

    public function setAccountType(?AccountType $accountType): self
    {
        $this->accountType = $accountType;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getAccountUser(): Collection
    {
        return $this->accountUser;
    }

    public function addAccountUser(User $accountUser): self
    {
        if (!$this->accountUser->contains($accountUser)) {
            $this->accountUser->add($accountUser);
        }

        return $this;
    }

    public function removeAccountUser(User $accountUser): self
    {
        $this->accountUser->removeElement($accountUser);

        return $this;
    }

    public function getToken(): ?string
    {
        return $this->token;
    }

    public function setToken(string $token): self
    {
        $this->token = $token;

        return $this;
    }
}
