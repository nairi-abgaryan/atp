<?php

namespace App\Repository;

use App\Entity\EcoGame;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method EcoGame|null find($id, $lockMode = null, $lockVersion = null)
 * @method EcoGame|null findOneBy(array $criteria, array $orderBy = null)
 * @method EcoGame[]    findAll()
 * @method EcoGame[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EcoGameRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, EcoGame::class);
    }
}
