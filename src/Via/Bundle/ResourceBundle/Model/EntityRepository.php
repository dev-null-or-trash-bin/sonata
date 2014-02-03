<?php
namespace Via\Bundle\ResourceBundle\Model;

use Doctrine\ORM\EntityRepository as BaseEntityRepository;
use Via\Bundle\ResourceBundle\Model\RepositoryInterface;

class EntityRepository extends BaseEntityRepository implements RepositoryInterface
{
    protected function getQueryBuilder()
    {
        return $this->createQueryBuilder($this->getAlias());
    }
    
    protected function getCollectionQueryBuilder()
    {
        return $this->createQueryBuilder($this->getAlias());
    }
    
    protected function getPropertyName($name)
    {
        if (false === strpos($name, '.')) {
            return $this->getAlias().'.'.$name;
        }
    
        return $name;
    }
    
    public function find($id)
    {
        return $this
        ->getQueryBuilder()
        ->andWhere($this->getAlias().'.id = '.intval($id))
        ->getQuery()
        ->getOneOrNullResult()
        ;
    }
    
    public function findAll()
    {
        return $this
        ->getCollectionQueryBuilder()
        ->getQuery()
        ->getResult()
        ;
    }
    
    public function findOneBy(array $criteria)
    {
        $queryBuilder = $this->getQueryBuilder();
    
        $this->applyCriteria($queryBuilder, $criteria);
    
        return $queryBuilder
        ->getQuery()
        ->getOneOrNullResult()
        ;
    }
    
    public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
    {
        $queryBuilder = $this->getCollectionQueryBuilder();
    
        $this->applyCriteria($queryBuilder, $criteria);
        $this->applySorting($queryBuilder, $orderBy);
    
        if (null !== $limit) {
            $queryBuilder->setMaxResults($limit);
        }
    
        if (null !== $offset) {
            $queryBuilder->setFirstResult($offset);
        }
    
        return $queryBuilder
        ->getQuery()
        ->getResult()
        ;
    }
    
    protected function getAlias()
    {
        return 'o';
    }
}