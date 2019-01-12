<?php

namespace App\Repository;

use App\Entity\Village;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Village|null find($id, $lockMode = null, $lockVersion = null)
 * @method Village|null findOneBy(array $criteria, array $orderBy = null)
 * @method Village[]    findAll()
 * @method Village[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VillageRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Village::class);
    }

    public function createNewVillage($village, $user, $name)
    {
        $em = $this->_em;
        $village->setUser($user);
        $village->setName($name);
        $em->persist($village);
        $em->flush();
    }
}
