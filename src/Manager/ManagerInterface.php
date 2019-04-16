<?php
namespace App\Manager;

interface ManagerInterface
{
    /**
     * @param $id
     */
    function find($id);

    /**
     * @param array $criteria
     * @return mixed
     */
    function findOneBy($criteria = []);

    /**
     * @param array $criteria
     * @return mixed
     */
    function findBy($criteria = []);

    /**
     * @return array
     */
    function findAll();

    /**
     * @param $entity
     * @return mixed
     */
    function persist($entity);

    /**
     * @return mixed
     */
    function create();
}