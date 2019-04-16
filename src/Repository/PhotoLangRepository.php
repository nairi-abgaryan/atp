<?php

namespace App\Repository;

use App\Entity\PhotoLang;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method PhotoLang|null find($id, $lockMode = null, $lockVersion = null)
 * @method PhotoLang|null findOneBy(array $criteria, array $orderBy = null)
 * @method PhotoLang[]    findAll()
 * @method PhotoLang[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PhotoLangRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PhotoLang::class);
    }
}
