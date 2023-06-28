<?php

namespace App\Entity;

use App\Repository\SmartphoneRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SmartphoneRepository::class)]
class Smartphone
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'smartphones')]
    private ?Brand $brand = null;

    #[ORM\ManyToOne(inversedBy: 'smartphones')]
    private ?Model $model = null;

    #[ORM\ManyToOne(inversedBy: 'smartphones')]
    private ?Ram $ram = null;

    #[ORM\ManyToOne(inversedBy: 'smartphones')]
    private ?Stockage $Stockage = null;

    #[ORM\ManyToOne(inversedBy: 'smartphones')]
    private ?Status $status = null;

    #[ORM\Column]
    private ?int $price = null;

    #[ORM\Column(nullable: true)]
    private ?bool $isSold = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBrand(): ?Brand
    {
        return $this->brand;
    }

    public function setBrand(?Brand $brand): static
    {
        $this->brand = $brand;

        return $this;
    }

    public function getModel(): ?Model
    {
        return $this->model;
    }

    public function setModel(?Model $model): static
    {
        $this->model = $model;

        return $this;
    }

    public function getRam(): ?Ram
    {
        return $this->ram;
    }

    public function setRam(?Ram $ram): static
    {
        $this->ram = $ram;

        return $this;
    }

    public function getStockage(): ?Stockage
    {
        return $this->Stockage;
    }

    public function setStockage(?Stockage $Stockage): static
    {
        $this->Stockage = $Stockage;

        return $this;
    }

    public function getStatus(): ?Status
    {
        return $this->status;
    }

    public function setStatus(?Status $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function isIsSold(): ?bool
    {
        return $this->isSold;
    }

    public function setIsSold(?bool $isSold): static
    {
        $this->isSold = $isSold;

        return $this;
    }
}
