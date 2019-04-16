<?php

namespace App\Repository;

use App\Entity\FeatureLang;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method FeatureLang|null find($id, $lockMode = null, $lockVersion = null)
 * @method FeatureLang|null findOneBy(array $criteria, array $orderBy = null)
 * @method FeatureLang[]    findAll()
 * @method FeatureLang[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FeatureLangRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, FeatureLang::class);
    }
}
