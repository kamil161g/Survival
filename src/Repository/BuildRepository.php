<?php

namespace App\Repository;

use App\Entity\Build;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Build|null find($id, $lockMode = null, $lockVersion = null)
 * @method Build|null findOneBy(array $criteria, array $orderBy = null)
 * @method Build[]    findAll()
 * @method Build[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BuildRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Build::class);
    }

    public function addHouse($build, $population, $user, $category)
    {

        $em = $this->_em;
        $build->setQuantity(1);
        $value = $build->getPopulation();
        $build->setPopulation($population + $value);
        $build->setUser($user);
        switch ($category)
        {
            case "House":
                $build->setCategory("House");
                break;
            case "Castle":
                $build->setCategory("Castle");
                break;

        }
        $em->persist($build);
        $em->flush();

    }
}
