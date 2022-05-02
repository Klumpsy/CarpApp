<?php

namespace App\Entity;

use App\Repository\SoortRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SoortRepository::class)]
class Soort
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\OneToMany(mappedBy: 'soort', targetEntity: Vangst::class)]
    private $soort;

    public function __toString() {
        return $this->name;
    }

    public function __construct()
    {
        $this->soort = new ArrayCollection();
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

    /**
     * @return Collection<int, Vangst>
     */
    public function getSoort(): Collection
    {
        return $this->soort;
    }

    public function addSoort(Vangst $soort): self
    {
        if (!$this->soort->contains($soort)) {
            $this->soort[] = $soort;
            $soort->setSoort($this);
        }

        return $this;
    }

    public function removeSoort(Vangst $soort): self
    {
        if ($this->soort->removeElement($soort)) {
            // set the owning side to null (unless already changed)
            if ($soort->getSoort() === $this) {
                $soort->setSoort(null);
            }
        }

        return $this;
    }
}
