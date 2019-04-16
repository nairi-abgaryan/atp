<?php

namespace App\Repository;

use App\Entity\NewsLang;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method NewsLang|null find($id, $lockMode = null, $lockVersion = null)
 * @method NewsLang|null findOneBy(array $criteria, array $orderBy = null)
 * @method NewsLang[]    findAll()
 * @method NewsLang[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NewsLangRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, NewsLang::class);
    }
}
