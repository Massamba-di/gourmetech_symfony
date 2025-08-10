<?php

namespace App\Entity;

use App\Repository\CommandesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommandesRepository::class)]
class Commandes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?\DateTime $dateCommandes = null;

    #[ORM\Column(length: 50)]
    private ?string $status = null;

    #[ORM\ManyToOne(inversedBy: 'commandes')]
    private ?Clients $clients = null;

    /**
     * @var Collection<int, Recettes>
     */
    #[ORM\ManyToMany(targetEntity: Recettes::class, inversedBy: 'commandes')]
    private Collection $recettes;

    #[ORM\ManyToOne(inversedBy: 'commandes')]
    private ?Addresses $addresses = null;

    public function __construct()
    {
        $this->recettes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateCommandes(): ?\DateTime
    {
        return $this->dateCommandes;
    }

    public function setDateCommandes(\DateTime $dateCommandes): static
    {
        $this->dateCommandes = $dateCommandes;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getClients(): ?Clients
    {
        return $this->clients;
    }

    public function setClients(?Clients $clients): static
    {
        $this->clients = $clients;

        return $this;
    }

    /**
     * @return Collection<int, Recettes>
     */
    public function getRecettes(): Collection
    {
        return $this->recettes;
    }

    public function addRecette(Recettes $recette): static
    {
        if (!$this->recettes->contains($recette)) {
            $this->recettes->add($recette);
        }

        return $this;
    }

    public function removeRecette(Recettes $recette): static
    {
        $this->recettes->removeElement($recette);

        return $this;
    }

    public function getAddresses(): ?Addresses
    {
        return $this->addresses;
    }

    public function setAddresses(?Addresses $addresses): static
    {
        $this->addresses = $addresses;

        return $this;
    }
}
