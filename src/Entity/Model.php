<?php

namespace App\Entity;

use App\Repository\ModelRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ModelRepository::class)]
class Model
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'models')]
    private ?Brand $brand = null;

    #[ORM\OneToMany(mappedBy: 'model', targetEntity: Smartphone::class)]
    private Collection $smartphones;

    #[ORM\Column]
    private ?int $value = null;

    public function __construct()
    {
        $this->smartphones = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getBrand(): ?Brand
    {
        return $this->brand;
    }

    public function setBrand(?Brand $brand): self
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * @return Collection<int, Smartphone>
     */
    public function getSmartphones(): Collection
    {
        return $this->smartphones;
    }

    public function addSmartphone(Smartphone $smartphone): static
    {
        if (!$this->smartphones->contains($smartphone)) {
            $this->smartphones->add($smartphone);
            $smartphone->setModel($this);
        }

        return $this;
    }

    public function removeSmartphone(Smartphone $smartphone): static
    {
        if ($this->smartphones->removeElement($smartphone)) {
            // set the owning side to null (unless already changed)
            if ($smartphone->getModel() === $this) {
                $smartphone->setModel(null);
            }
        }

        return $this;
    }

    public function getValue(): ?int
    {
        return $this->value;
    }

    public function setValue(int $value): static
    {
        $this->value = $value;

        return $this;
    }
}
