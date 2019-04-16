<?php

namespace App\Repository;

use App\Entity\ColoringLang;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ColoringLang|null find($id, $lockMode = null, $lockVersion = null)
 * @method ColoringLang|null findOneBy(array $criteria, array $orderBy = null)
 * @method ColoringLang[]    findAll()
 * @method ColoringLang[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ColoringLangRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ColoringLang::class);
    }
}
