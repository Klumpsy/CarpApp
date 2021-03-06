<?php

namespace App\Entity;

use App\Repository\VisserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VisserRepository::class)]
#[ORM\Table(name: '`visser`')]
class Visser
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $image;

    #[ORM\OneToMany(mappedBy: 'visser', targetEntity: Vangst::class)]
    private $vangsten;

    #[ORM\ManyToOne(targetEntity: Water::class, inversedBy: 'visserFavorite')]
    private $favoriteWater;

    public function __construct()
    {
        $this->vangsten = new ArrayCollection();
    }

    public function __toString(){
        return $this->name;
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

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return Collection<int, Vangst>
     */
    public function getVangsten(): Collection
    {
        return $this->vangsten;
    }

    public function addVangsten(Vangst $vangsten): self
    {
        if (!$this->vangsten->contains($vangsten)) {
            $this->vangsten[] = $vangsten;
            $vangsten->setVisser($this);
        }

        return $this;
    }

    public function removeVangsten(Vangst $vangsten): self
    {
        if ($this->vangsten->removeElement($vangsten)) {
            // set the owning side to null (unless already changed)
            if ($vangsten->getVisser() === $this) {
                $vangsten->setVisser(null);
            }
        }

        return $this;
    }

    public function getFavoriteWater(): ?Water
    {
        return $this->favoriteWater;
    }

    public function setFavoriteWater(?Water $favoriteWater): self
    {
        $this->favoriteWater = $favoriteWater;

        return $this;
    }

}
