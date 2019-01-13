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
}
