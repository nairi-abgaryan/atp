<?php

namespace App\Repository;

use App\Entity\Feature;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Feature|null find($id, $lockMode = null, $lockVersion = null)
 * @method Feature|null findOneBy(array $criteria, array $orderBy = null)
 * @method Feature[]    findAll()
 * @method Feature[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FeatureRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Feature::class);
    }

    /**
     * @param $linkName
     * @return mixed
     */
    public function findByLinkName($linkName)
    {
        $qb = $this->createQueryBuilder("feature");

        $qb
            ->select("feature, entityLang")
            ->leftJoin("feature.entityLang", "entityLang")
            ->innerJoin("App:Page", "pages", "WITH", "pages.linkName = :linkName")
            ->setParameter("linkName", $linkName);

        return $qb->getQuery()->getResult();
    }
}
