<?php
namespace App\Manager;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Component\Form\FormFactoryInterface;

class BaseManager
{
    /**
     * @var ServiceEntityRepository
     */
    private $repository;

    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * @var FormFactoryInterface $form
     */
    protected $form;

    /**
     * BaseManager constructor.
     * @param ServiceEntityRepository $repository
     * @param EntityManagerInterface $em
     */
    public function __construct
    (
        ServiceEntityRepository $repository,
        EntityManagerInterface $em
    )
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @param $id
     *
     * @return object|null|mixed
     */
    public function find($id)
    {
        return $this->repository->find($id);
    }

    /**
     * @param array $criteria
     *
     * @return object|null|User
     */
    public function findOneBy($criteria = [])
    {
        return $this->repository->findOneBy($criteria);
    }

    /**
     * @param array $criteria
     * @param array $order
     * @return array
     */
    public function findBy($criteria = [], $order = [])
    {
        $qb = $this->repository->findBy($criteria, $order);

        return $qb;
    }

    /**
     * @return array
     */
    function findAll()
    {
        return $this->repository->findAll();
    }

    /**
     * @return array|\Doctrine\ORM\QueryBuilder
     */
    public function findList()
    {
        $qb = $this->repository->createQueryBuilder("alias");

        return $qb;
    }

    /**
     * @param $entity
     * @return mixed
     */
    public function persist($entity)
    {
        $this->em->persist($entity);
        $this->em->flush();

        return $entity;
    }

    /**
     * @param $entity
     * @return mixed
     */
    public function merge($entity)
    {
        $this->em->merge($entity);
        $this->em->flush();

        return $entity;
    }

    /**
     * @param $entity
     * @return mixed
     */
    public function remove($entity)
    {
        $this->em->remove($entity);
        $this->em->flush();

        return $entity;
    }

    /**
     * @param $entity
     * @return mixed
     */
    public function onlyPersist($entity)
    {
        $this->em->persist($entity);

        return $entity;
    }

    public function flush()
    {
        $this->em->flush();
    }
}