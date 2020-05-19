<?php

namespace App\Entity;

use App\Repository\CoffeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CoffeRepository::class)
 */
class Coffe
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean")
     */
    private $milk;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $milk_type;

    /**
     * @ORM\Column(type="string", length=1)
     */
    private $cup_size;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $location;

    /**
     * @ORM\Column(type="datetime")
     */
    private $deliver_on;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMilk(): ?bool
    {
        return $this->milk;
    }

    public function setMilk(bool $milk): self
    {
        $this->milk = $milk;

        return $this;
    }

    public function getMilkType(): ?string
    {
        return $this->milk_type;
    }

    public function setMilkType(string $milk_type): self
    {
        $this->milk_type = $milk_type;

        return $this;
    }

    public function getCupSize(): ?string
    {
        return $this->cup_size;
    }

    public function setCupSize(string $cup_size): self
    {
        $this->cup_size = $cup_size;

        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(string $location): self
    {
        $this->location = $location;

        return $this;
    }

    public function getDeliverOn(): ?\DateTimeInterface
    {
        return $this->deliver_on;
    }

    public function setDeliverOn(\DateTimeInterface $deliver_on): self
    {
        $this->deliver_on = $deliver_on;

        return $this;
    }
}
