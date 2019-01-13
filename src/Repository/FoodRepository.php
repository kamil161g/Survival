<?php

namespace App\Repository;

use App\Entity\Food;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Food|null find($id, $lockMode = null, $lockVersion = null)
 * @method Food|null findOneBy(array $criteria, array $orderBy = null)
 * @method Food[]    findAll()
 * @method Food[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FoodRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Food::class);
    }

    public function addFood($user, $value)
    {
        $em = $this->_em;
        $user->setValue($value);
        $em->persist($user);
        $em->flush();
    }


}
