<?php

namespace App\Repository;

use App\Entity\Coloring;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Coloring|null find($id, $lockMode = null, $lockVersion = null)
 * @method Coloring|null findOneBy(array $criteria, array $orderBy = null)
 * @method Coloring[]    findAll()
 * @method Coloring[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ColoringRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Coloring::class);
    }
}
