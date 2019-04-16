<?php

namespace App\Repository;

use App\Entity\AmbassadorLang;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method AmbassadorLang|null find($id, $lockMode = null, $lockVersion = null)
 * @method AmbassadorLang|null findOneBy(array $criteria, array $orderBy = null)
 * @method AmbassadorLang[]    findAll()
 * @method AmbassadorLang[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AmbassadorLangRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, AmbassadorLang::class);
    }
}
