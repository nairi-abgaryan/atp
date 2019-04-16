<?php

namespace App\Repository;

use App\Entity\EventLang;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method EventLang|null find($id, $lockMode = null, $lockVersion = null)
 * @method EventLang|null findOneBy(array $criteria, array $orderBy = null)
 * @method EventLang[]    findAll()
 * @method EventLang[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EventLangRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, EventLang::class);
    }
}
