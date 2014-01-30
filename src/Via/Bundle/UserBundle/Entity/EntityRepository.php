<?php
namespace Via\Bundle\UserBundle\Entity;

use Doctrine\ORM\EntityRepository as BaseEntityRepository;

class EntityRepository extends BaseEntityRepository
{
    protected function getQueryBuilder()
    {
        return $this->createQueryBuilder($this->getAlias());
    }
    
    protected function getCollectionQueryBuilder()
    {
        return $this->createQueryBuilder($this->getAlias());
    }
}