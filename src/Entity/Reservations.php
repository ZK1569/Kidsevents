<?php

namespace App\Entity;

use App\Repository\ReservationsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReservationsRepository::class)]
class Reservations
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer')]
    private $nbenfants;

    #[ORM\Column(type: 'date')]
    private $date;

    #[ORM\Column(type: 'float')]
    private $prix;

    #[ORM\ManyToOne(targetEntity: Themes::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $theme;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNbenfants(): ?int
    {
        return $this->nbenfants;
    }

    public function setNbenfants(int $nbenfants): self
    {
        $this->nbenfants = $nbenfants;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getClient(): ?Users
    {
        return $this->client;
    }

    public function setClient(?Users $client): self
    {
        $this->client = $client;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getTheme(): ?Themes
    {
        return $this->theme;
    }

    public function setTheme(?Themes $theme): self
    {
        $this->theme = $theme;

        return $this;
    }
}
