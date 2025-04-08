<?php

namespace App\Entity;

use App\Repository\EnclosRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EnclosRepository::class)]
class Enclos
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column]
    private ?float $temperature = null;

    /**
     * @var Collection<int, Pingouin>
     */
    #[ORM\OneToMany(targetEntity: Pingouin::class, mappedBy: 'enclos')]
    private Collection $pingouins;

    public function __toString(): string
    {
        return $this->nom;
    }

    public function __construct()
    {
        $this->pingouins = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getTemperature(): ?float
    {
        return $this->temperature;
    }

    public function setTemperature(float $temperature): static
    {
        $this->temperature = $temperature;

        return $this;
    }

    /**
     * @return Collection<int, Pingouin>
     */
    public function getPingouins(): Collection
    {
        return $this->pingouins;
    }

    public function addPingouin(Pingouin $pingouin): static
    {
        if (!$this->pingouins->contains($pingouin)) {
            $this->pingouins->add($pingouin);
            $pingouin->setEnclos($this);
        }

        return $this;
    }

    public function removePingouin(Pingouin $pingouin): static
    {
        if ($this->pingouins->removeElement($pingouin)) {
            // set the owning side to null (unless already changed)
            if ($pingouin->getEnclos() === $this) {
                $pingouin->setEnclos(null);
            }
        }

        return $this;
    }
}
