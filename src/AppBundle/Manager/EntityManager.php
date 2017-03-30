<?php

namespace AppBundle\Manager;

use GraphAware\Neo4j\OGM\EntityManager as BaseEntityManager;

class EntityManager
{
    protected $entityManager;

    public function __construct($cacheDir)
    {
        $this->entityManager = BaseEntityManager::create('http://localhost:7474', $cacheDir);
    }

    /**
     * @return BaseEntityManager
     */
    public function getEntityManager()
    {
        return $this->entityManager;
    }
}