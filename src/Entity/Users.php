<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UsersRepository")
 */
class Users implements  UserInterface
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
    private $login;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    private $plainPassword;

    /**
     * @ORM\Column(unique= true, type="string", length=255)
     */
    private $email;

    /**
     * @var Village
     * @ORM\OneToMany(targetEntity="App\Entity\Village", mappedBy="user")
     * @ORM\JoinColumn(name="id", referencedColumnName="id")
     */
    private $village;

    /**
     * @var StatusMission
     * @ORM\OneToMany(targetEntity="App\Entity\StatusMission", mappedBy="user")
     * @ORM\JoinColumn(name="id", referencedColumnName="id")
     */
    private $statusMission;

    /**
     * @var Build
     * @ORM\OneToMany(targetEntity="App\Entity\Build", mappedBy="user")
     * @ORM\JoinColumn(name="id", referencedColumnName="id")
     */
    private $build;

    /**
     * @var Stat
     * @ORM\OneToMany(targetEntity="App\Entity\Stat", mappedBy="user")
     * @ORM\JoinColumn(name="id", referencedColumnName="id")
     */
    private $stat;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(string $login): self
    {
        $this->login = $login;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @param mixed $password
     */
    public function setPlainPassword($password)
    {
        $this->plainPassword = $password;
    }

    /**
     * @return mixed
     */
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }


    /**
     * Returns the roles granted to the user.
     *
     *     public function getRoles()
     *     {
     *         return array('ROLE_USER');
     *     }
     *
     * Alternatively, the roles might be stored on a ``roles`` property,
     * and populated in any number of different ways when the user object
     * is created.
     *
     * @return (Role|string)[] The user roles
     */
    public function getRoles()
    {
        return array('ROLE_USER');
    }

    /**
     * Returns the salt that was originally used to encode the password.
     *
     * This can return null if the password was not encoded using a salt.
     *
     * @return string|null The salt
     */
    public function getSalt()
    {
        // TODO: Implement getSalt() method.
    }

    /**
     * Returns the username used to authenticate the user.
     *
     * @return string The username
     */
    public function getUsername()
    {
        // TODO: Implement getUsername() method.
    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    public function __construct()
    {
        $this->village = new ArrayCollection();
        $this->food = new ArrayCollection();
        $this->statusMission = new ArrayCollection();
        $this->build = new ArrayCollection();
        $this->stat = new ArrayCollection();
    }

    /**
     * @param Village $village
     * @return $this
     */
    public function setUsers(Village $village)
    {
        $this->village[] = $village;

        return $this;
    }

    /**
     * @return Village[]|ArrayCollection
     */
    public function getUsers()
    {
        return $this->village;
    }

    /**
     * @param Food $food
     * @return $this
     */
    public function setFood(Food $food)
    {
        $this->food[] = $food;

        return $this;
    }

    /**
     * @return Food[]|ArrayCollection
     */
    public function getFood()
    {
        return $this->food;
    }

    /**
     * @return StatusMission
     */
    public function getStatusMission(): StatusMission
    {
        return $this->statusMission;
    }

    /**
     * @param StatusMission $statusMission
     */
    public function setStatusMission(StatusMission $statusMission)
    {
        $this->statusMission = $statusMission;
    }

    /**
     * @return Build
     */
    public function getBuild(): Build
    {
        return $this->build;
    }

    /**
     * @param Build $build
     */
    public function setBuild(Build $build)
    {
        $this->build = $build;
    }

    /**
     * @return Village
     */
    public function getVillage(): Village
    {
        return $this->village;
    }

    /**
     * @param Village $village
     */
    public function setVillage(Village $village)
    {
        $this->village = $village;
    }

    /**
     * @return Stat
     */
    public function getStat(): Stat
    {
        return $this->stat;
    }

    /**
     * @param Stat $stat
     */
    public function setStat(Stat $stat)
    {
        $this->stat = $stat;
    }


}
