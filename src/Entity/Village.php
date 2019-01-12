<?php

namespace App\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\User;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VillageRepository")
 */
class Village
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     */
    private $wood = 100;

    /**
     * @ORM\Column(type="integer")
     */
    private $stone = 100;

    /**
     * @ORM\Column(type="integer")
     */
    private $food = 100;

    /**
     * @ORM\Column(type="integer")
     */
    private $gold = 0;

    /**
     * @ORM\Column(type="integer")
     */
    private $carbon = 100;

    /**
     * @ORM\Column(type="integer")
     */
    private $population = 100;

    /**
     * @ORM\Column(type="integer")
     */
    private $level = 1;

    /**
     * @var Users
     * @ORM\ManyToOne(targetEntity="App\Entity\Users", inversedBy="village")
     */
    private $user;

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

    public function getWood(): ?int
    {
        return $this->wood;
    }

    public function setWood(int $wood): self
    {
        $this->wood = $wood;

        return $this;
    }

    public function getStone(): ?int
    {
        return $this->stone;
    }

    public function setStone(int $stone): self
    {
        $this->stone = $stone;

        return $this;
    }

    public function getFood(): ?int
    {
        return $this->food;
    }

    public function setFood(int $food): self
    {
        $this->food = $food;

        return $this;
    }

    public function getGold(): ?int
    {
        return $this->gold;
    }

    public function setGold(int $gold): self
    {
        $this->gold = $gold;

        return $this;
    }

    public function getCarbon(): ?int
    {
        return $this->carbon;
    }

    public function setCarbon(int $carbon): self
    {
        $this->carbon = $carbon;

        return $this;
    }

    public function getPopulation(): ?int
    {
        return $this->population;
    }

    public function setPopulation(int $population): self
    {
        $this->population = $population;

        return $this;
    }

    public function getLevel(): ?int
    {
        return $this->level;
    }

    public function setLevel(int $level): self
    {
        $this->level = $level;

        return $this;
    }

    /**
     * @return Users
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param Users $users
     * @return $this
     */
    public function setUser(Users $users)
    {
        $this->user = $users;

        return $this;
    }



}
