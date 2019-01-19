<?php

namespace App\Repository;

use App\Entity\Material;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Material|null find($id, $lockMode = null, $lockVersion = null)
 * @method Material|null findOneBy(array $criteria, array $orderBy = null)
 * @method Material[]    findAll()
 * @method Material[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MaterialRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Material::class);
    }

    public function addFood($material, $value)
    {
        $em = $this->_em;
        $material->setValue($value);
        $em->persist($material);
        $em->flush();
    }

    public function addStone($material, $value)
    {
        $em = $this->_em;
        $material->setValue($value);
        $em->persist($material);
        $em->flush();
    }

    public function addGold($material, $value)
    {
        $em = $this->_em;
        $material->setValue($value);
        $em->persist($material);
        $em->flush();
    }

    public function addWood($material, $value)
    {
        $em = $this->_em;
        $material->setValue($value);
        $em->persist($material);
        $em->flush();
    }

    public function addCarbon($material, $value)
    {
        $em = $this->_em;
        $material->setValue($value);
        $em->persist($material);
        $em->flush();
    }

    public function addLevel($material)
    {
        $em = $this->_em;
        $level = $material->getLevel();
        $material->setLevel($level+1);
        $em->persist($material);
        $em->flush();
    }

    public function createMaterial($user)
    {
        $em = $this->_em;

        for ($i=0; $i <= 4; $i++)
        {
            switch ($i) {
                case 0:
                    $material = new Material();
                    $material->setCategory('Food');
                    $material->setValue('100');
                    $material->setLevel('1');
                    $material->setUser($user);
                    $em->persist($material);
                    $em->flush();
                    break;
                case 1:
                    $material = new Material();
                    $em = $this->_em;
                    $material->setCategory('Wood');
                    $material->setValue('100');
                    $material->setLevel('1');
                    $material->setUser($user);
                    $em->persist($material);
                    $em->flush();
                    break;
                case 2:
                    $material = new Material();
                    $material->setCategory('Stone');
                    $material->setValue('100');
                    $material->setLevel('1');
                    $material->setUser($user);
                    $em->persist($material);
                    $em->flush();
                    break;
                case 3:
                    $material = new Material();
                    $material->setCategory('Carbon');
                    $material->setValue('100');
                    $material->setLevel('1');
                    $material->setUser($user);
                    $em->persist($material);
                    $em->flush();
                    break;
                case 4:
                    $material = new Material();
                    $em = $this->_em;
                    $material->setCategory('Gold');
                    $material->setValue('100');
                    $material->setLevel('1');
                    $material->setUser($user);
                    $em->persist($material);
                    $em->flush();
                    break;
            }
        }


    }

    public function removeGold($user, $gold)
    {
        $em = $this->_em;
        $user->setValue($user->getValue()-$gold);
        $em->persist($user);
        $em->flush();
    }

    public function removeCarbon($user, $carbon)
    {
        $em = $this->_em;
        $user->setValue($user->getValue()-$carbon);
        $em->persist($user);
        $em->flush();
    }

    public function removeFood($user, $food)
    {
        $em = $this->_em;
        $user->setValue($user->getValue()-$food);
        $em->persist($user);
        $em->flush();
    }

    public function removeWood($user, $wood)
    {
        $em = $this->_em;
        $user->setValue($user->getValue()-$wood);
        $em->persist($user);
        $em->flush();
    }
}
