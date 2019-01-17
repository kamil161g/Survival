<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\StatRepository")
 */
class Stat
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
    private $category;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $valueMin;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $valueMax;

    /**
     * @var Users
     * @ORM\ManyToOne(targetEntity="App\Entity\Users", inversedBy="stat")
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(string $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getValueMin(): ?int
    {
        return $this->valueMin;
    }

    public function setValueMin(int $valueMin): self
    {
        $this->valueMin = $valueMin;

        return $this;
    }

    public function getValueMax(): ?int
    {
        return $this->valueMax;
    }

    public function setValueMax(int $valueMax): self
    {
        $this->valueMax = $valueMax;

        return $this;
    }

    /**
     * @return Users
     */
    public function getUser(): Users
    {
        return $this->user;
    }

    /**
     * @param Users $user
     */
    public function setUser(Users $user)
    {
        $this->user = $user;
    }


}
