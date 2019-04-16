<?php

namespace App\Repository;

use App\Entity\TeamBranchLang;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method TeamBranchLang|null find($id, $lockMode = null, $lockVersion = null)
 * @method TeamBranchLang|null findOneBy(array $criteria, array $orderBy = null)
 * @method TeamBranchLang[]    findAll()
 * @method TeamBranchLang[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TeamBranchLangRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TeamBranchLang::class);
    }

    // /**
    //  * @return TeamBranchLang[] Returns an array of TeamBranchLang objects
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
    public function findOneBySomeField($value): ?TeamBranchLang
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
