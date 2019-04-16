<?php

namespace App\Manager;

use App\Entity\News;
use App\Repository\NewsRepository;
use Doctrine\ORM\EntityManagerInterface;

class NewsManager extends BaseManager implements ManagerInterface
{
    /**
     * @var NewsRepository
     */
    private $repository;

    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * NewsManager constructor.
     * @param NewsRepository $repository
     * @param EntityManagerInterface $em
     */
    public function __construct
    (
        NewsRepository $repository,
        EntityManagerInterface $em
    )
    {
        parent::__construct($repository, $em);
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @return News
     */
    public function create()
    {
        return new News();
    }
}
