<?php

namespace App\Repository;

use App\Entity\TeamBranch;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method TeamBranch|null find($id, $lockMode = null, $lockVersion = null)
 * @method TeamBranch|null findOneBy(array $criteria, array $orderBy = null)
 * @method TeamBranch[]    findAll()
 * @method TeamBranch[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TeamBranchRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TeamBranch::class);
    }

    // /**
    //  * @return TeamBranch[] Returns an array of TeamBranch objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TeamBranch
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
