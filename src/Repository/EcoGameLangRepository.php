<?php

namespace App\Repository;

use App\Entity\EcoGameLang;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method EcoGameLang|null find($id, $lockMode = null, $lockVersion = null)
 * @method EcoGameLang|null findOneBy(array $criteria, array $orderBy = null)
 * @method EcoGameLang[]    findAll()
 * @method EcoGameLang[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EcoGameLangRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, EcoGameLang::class);
    }
}
