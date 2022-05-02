<?php

namespace App\Entity;

use App\Repository\LandRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LandRepository::class)]
class Land
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\OneToMany(mappedBy: 'land', targetEntity: Vangst::class)]
    private $land;

    public function __toString() {
        return $this->name;
    }

    public function __construct()
    {
        $this->land = new ArrayCollection();
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
    public function getLand(): Collection
    {
        return $this->land;
    }

    public function addLand(Vangst $land): self
    {
        if (!$this->land->contains($land)) {
            $this->land[] = $land;
            $land->setLand($this);
        }

        return $this;
    }

    public function removeLand(Vangst $land): self
    {
        if ($this->land->removeElement($land)) {
            // set the owning side to null (unless already changed)
            if ($land->getLand() === $this) {
                $land->setLand(null);
            }
        }

        return $this;
    }
}
