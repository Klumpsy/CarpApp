<?php

namespace App\Entity;

use App\Repository\VangstRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VangstRepository::class)]
class Vangst
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'float')]
    private $gewicht;

    #[ORM\ManyToOne(targetEntity: Soort::class, inversedBy: 'soort')]
    #[ORM\JoinColumn(nullable: false)]
    private $soort;

    #[ORM\Column(type: 'integer')]
    private $diepte;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $image;

    #[ORM\ManyToOne(targetEntity: Land::class, inversedBy: 'land')]
    #[ORM\JoinColumn(nullable: false)]
    private $land;

    #[ORM\Column(type: 'date')]
    private $datum;

    #[ORM\Column(type: 'time')]
    private $tijd;

    #[ORM\Column(type: 'string', length: 2500, nullable: true)]
    private $aantekeningen;

    #[ORM\ManyToOne(targetEntity: Water::class, inversedBy: 'vangsten')]
    #[ORM\JoinColumn(nullable: false)]
    private $water;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $rig;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $graden;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $windrichting;

    #[ORM\Column(type: 'float', nullable: true)]
    private $luchtdruk;

    #[ORM\Column(type: 'float', nullable: true)]
    private $windsnelheid;

    #[ORM\ManyToOne(targetEntity: Visser::class, inversedBy: 'vangsten')]
    private $visser;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGewicht(): ?float
    {
        return $this->gewicht;
    }

    public function setGewicht(float $gewicht): self
    {
        $this->gewicht = $gewicht;

        return $this;
    }

    public function getSoort(): ?Soort
    {
        return $this->soort;
    }

    public function setSoort(?Soort $soort): self
    {
        $this->soort = $soort;

        return $this;
    }

    public function getDiepte(): ?int
    {
        return $this->diepte;
    }

    public function setDiepte(int $diepte): self
    {
        $this->diepte = $diepte;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

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

    public function getDatum(): ?\DateTimeInterface
    {
        return $this->datum;
    }

    public function setDatum(\DateTimeInterface $datum): self
    {
        $this->datum = $datum;

        return $this;
    }

    public function getTijd(): ?\DateTimeInterface
    {
        return $this->tijd;
    }

    public function setTijd(\DateTimeInterface $tijd): self
    {
        $this->tijd = $tijd;

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

    public function getWater(): ?Water
    {
        return $this->water;
    }

    public function setWater(?Water $water): self
    {
        $this->water = $water;

        return $this;
    }

    public function getRig(): ?string
    {
        return $this->rig;
    }

    public function setRig(?string $rig): self
    {
        $this->rig = $rig;

        return $this;
    }

    public function getGraden(): ?int
    {
        return $this->graden;
    }

    public function setGraden(?int $graden): self
    {
        $this->graden = $graden;

        return $this;
    }

    public function getWindrichting(): ?string
    {
        return $this->windrichting;
    }

    public function setWindrichting(?string $windrichting): self
    {
        $this->windrichting = $windrichting;

        return $this;
    }

    public function getLuchtdruk(): ?float
    {
        return $this->luchtdruk;
    }

    public function setLuchtdruk(?float $luchtdruk): self
    {
        $this->luchtdruk = $luchtdruk;

        return $this;
    }

    public function getWindsnelheid(): ?float
    {
        return $this->windsnelheid;
    }

    public function setWindsnelheid(?float $windsnelheid): self
    {
        $this->windsnelheid = $windsnelheid;

        return $this;
    }

    public function getVisser(): ?Visser
    {
        return $this->visser;
    }

    public function setVisser(?Visser $visser): self
    {
        $this->visser = $visser;

        return $this;
    }
}
