<?php

namespace App\Repository;

use App\Entity\Stat;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Stat|null find($id, $lockMode = null, $lockVersion = null)
 * @method Stat|null findOneBy(array $criteria, array $orderBy = null)
 * @method Stat[]    findAll()
 * @method Stat[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StatRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Stat::class);
    }

    public function addPoints($valueMin = null, $valueMax, $stat)
    {
        $em = $this->_em;
        $stat->setValueMin($valueMin);
        $stat->setValueMax($valueMax);
        $em->persist($stat);
        $em->flush();
    }

    public function addDefense($value, $stat)
    {
        $em = $this->_em;
        $stat->setValueMax($value);
        $em->persist($stat);
        $em->flush();
    }
}
