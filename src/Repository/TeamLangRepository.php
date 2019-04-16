<?php

namespace App\Repository;

use App\Entity\TeamLang;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method TeamLang|null find($id, $lockMode = null, $lockVersion = null)
 * @method TeamLang|null findOneBy(array $criteria, array $orderBy = null)
 * @method TeamLang[]    findAll()
 * @method TeamLang[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TeamLangRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TeamLang::class);
    }
}
