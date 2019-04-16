<?php

namespace App\Repository;

use App\Entity\VideoLang;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method VideoLang|null find($id, $lockMode = null, $lockVersion = null)
 * @method VideoLang|null findOneBy(array $criteria, array $orderBy = null)
 * @method VideoLang[]    findAll()
 * @method VideoLang[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VideoLangRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, VideoLang::class);
    }
}
