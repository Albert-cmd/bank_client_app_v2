<?php

namespace App\Entity;

use App\Repository\ClientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ClientRepository::class)
 */
class Client
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $dni;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $cognoms;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dataN;

    /**
     * @ORM\OneToOne(targetEntity=Usuari::class, inversedBy="clients", cascade={"persist", "remove"})
     */
    private $usuari;

    /**
     * @ORM\OneToMany(targetEntity=Compte::class, mappedBy="client")
     */
    private $clients;

    public function __construct()
    {
        $this->clients = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDni(): ?string
    {
        return $this->dni;
    }

    public function setDni(?string $dni): self
    {
        $this->dni = $dni;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getCognoms(): ?string
    {
        return $this->cognoms;
    }

    public function setCognoms(?string $cognoms): self
    {
        $this->cognoms = $cognoms;

        return $this;
    }

    public function getDataN(): ?\DateTimeInterface
    {
        return $this->dataN;
    }

    public function setDataN(?\DateTimeInterface $dataN): self
    {
        $this->dataN = $dataN;

        return $this;
    }

    public function getUsuari(): ?Usuari
    {
        return $this->usuari;
    }

    public function setUsuari(?Usuari $usuari): self
    {
        $this->usuari = $usuari;

        return $this;
    }

    /**
     * @return Collection|Compte[]
     */
    public function getClients(): Collection
    {
        return $this->clients;
    }

    public function addClient(Compte $client): self
    {
        if (!$this->clients->contains($client)) {
            $this->clients[] = $client;
            $client->setClient($this);
        }

        return $this;
    }

    public function removeClient(Compte $client): self
    {
        if ($this->clients->removeElement($client)) {
            // set the owning side to null (unless already changed)
            if ($client->getClient() === $this) {
                $client->setClient(null);
            }
        }

        return $this;
    }
}
