<?php
namespace Via\Bundle\BlackboxBundle\Entity;

use Via\Bundle\ResourceBundle\Model\EntityRepository;

class UserRepository extends EntityRepository
{
    public function findEnabledUser ($user)
    {
        $queryBuilder = $this->getCollectionQueryBuilder();
        
        $queryBuilder
            ->Where('user.id != :id')
            ->andWhere('user.enviroment = :enviroment')
            ->setParameter('id', $user->getId())
            ->setParameter('enviroment', $user->getEnviroment());
        ;
        
        return $queryBuilder->getQuery()->getResult();
	}
	
	/**
	 * {@inheritdoc}
	 */
	protected function getAlias()
	{
	    return 'user';
	}

}