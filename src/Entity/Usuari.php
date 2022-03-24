<?php

namespace App\Entity;

use App\Repository\UsuariRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UsuariRepository::class)
 */
class Usuari
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
    private $username;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $password;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $validat;

    /**
     * @ORM\OneToOne(targetEntity=Client::class, mappedBy="usuari", cascade={"persist", "remove"})
     */
    private $clients;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(?string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getValidat(): ?bool
    {
        return $this->validat;
    }

    public function setValidat(?bool $validat): self
    {
        $this->validat = $validat;

        return $this;
    }

    public function getClients(): ?Client
    {
        return $this->clients;
    }

    public function setClients(?Client $clients): self
    {
        // unset the owning side of the relation if necessary
        if ($clients === null && $this->clients !== null) {
            $this->clients->setUsuari(null);
        }

        // set the owning side of the relation if necessary
        if ($clients !== null && $clients->getUsuari() !== $this) {
            $clients->setUsuari($this);
        }

        $this->clients = $clients;

        return $this;
    }
}
