<?php

namespace App\Manager;

use App\Entity\Feature;
use App\Repository\FeatureRepository;
use Doctrine\ORM\EntityManagerInterface;

class FeatureManager extends BaseManager implements ManagerInterface
{
    /**
     * @var FeatureRepository
     */
    private $repository;

    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * FeatureManager constructor.
     * @param FeatureRepository $repository
     * @param EntityManagerInterface $em
     */
    public function __construct
    (
        FeatureRepository $repository,
        EntityManagerInterface $em
    )
    {
        parent::__construct($repository, $em);
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @return Feature
     */
    public function create()
    {
        return new Feature();
    }

    /**
     * @param $linkName
     * @return mixed
     */
    public function findByLinkName($linkName)
    {
        return $this->repository->findByLinkName($linkName);
    }
}
