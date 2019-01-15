<?php

namespace App\Repository;

use App\Entity\StatusMission;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method StatusMission|null find($id, $lockMode = null, $lockVersion = null)
 * @method StatusMission|null findOneBy(array $criteria, array $orderBy = null)
 * @method StatusMission[]    findAll()
 * @method StatusMission[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StatusMissionRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, StatusMission::class);
    }

    public function addStatus($status, $user)
    {
        $em = $this->_em;
        $status->setStatus(1);
        $status->setUser($user);
        $status->setFinishTime(new \DateTime('@'.strtotime('now + 10 minutes + 1 hours')));
        $em->persist($status);
        $em->flush();
    }

    public function removeStatus($status)
    {
        $em = $this->_em;
        $em->remove($status);
        $em->flush();
    }
}
