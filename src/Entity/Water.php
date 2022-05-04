<?php

namespace App\Entity;

use App\Repository\WaterRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WaterRepository::class)]
class Water
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    public function __toString(){
        return $this->name;
    }

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\ManyToOne(targetEntity: Land::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $land;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $type;

    #[ORM\Column(type: 'boolean')]
    private $nachtvissen;

    #[ORM\Column(type: 'boolean')]
    private $boot;

    #[ORM\Column(type: 'boolean')]
    private $voerboot;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $bereikbaarheid;

    #[ORM\Column(type: 'float')]
    private $oppervlakte;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $image;

    #[ORM\Column(type: 'string', length: 5000, nullable: true)]
    private $aantekeningen;

    #[ORM\OneToMany(mappedBy: 'water', targetEntity: Vangst::class)]
    private $vangsten;

    public function __construct()
    {
        $this->vangsten = new ArrayCollection();
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

    public function getLand(): ?Land
    {
        return $this->land;
    }

    public function setLand(?Land $land): self
    {
        $this->land = $land;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getNachtvissen(): ?bool
    {
        return $this->nachtvissen;
    }

    public function setNachtvissen(bool $nachtvissen): self
    {
        $this->nachtvissen = $nachtvissen;

        return $this;
    }

    public function getBoot(): ?bool
    {
        return $this->boot;
    }

    public function setBoot(bool $boot): self
    {
        $this->boot = $boot;

        return $this;
    }

    public function getVoerboot(): ?bool
    {
        return $this->voerboot;
    }

    public function setVoerboot(bool $voerboot): self
    {
        $this->voerboot = $voerboot;

        return $this;
    }

    public function getBereikbaarheid(): ?string
    {
        return $this->bereikbaarheid;
    }

    public function setBereikbaarheid(?string $bereikbaarheid): self
    {
        $this->bereikbaarheid = $bereikbaarheid;

        return $this;
    }

    public function getOppervlakte(): ?float
    {
        return $this->oppervlakte;
    }

    public function setOppervlakte(float $oppervlakte): self
    {
        $this->oppervlakte = $oppervlakte;

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

    public function getAantekeningen(): ?string
    {
        return $this->aantekeningen;
    }

    public function setAantekeningen(?string $aantekeningen): self
    {
        $this->aantekeningen = $aantekeningen;

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
            $vangsten->setWater($this);
        }

        return $this;
    }

    public function removeVangsten(Vangst $vangsten): self
    {
        if ($this->vangsten->removeElement($vangsten)) {
            // set the owning side to null (unless already changed)
            if ($vangsten->getWater() === $this) {
                $vangsten->setWater(null);
            }
        }

        return $this;
    }
}