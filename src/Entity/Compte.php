<?php

namespace App\Entity;

use App\Repository\CompteRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CompteRepository::class)
 */
class Compte
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
    private $codi;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $saldo;

    /**
     * @ORM\ManyToOne(targetEntity=Client::class, inversedBy="clients")
     */
    private $client;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodi(): ?string
    {
        return $this->codi;
    }

    public function setCodi(?string $codi): self
    {
        $this->codi = $codi;

        return $this;
    }

    public function getSaldo(): ?int
    {
        return $this->saldo;
    }

    public function setSaldo(?int $saldo): self
    {
        $this->saldo = $saldo;

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

        return $this;
    }
}
