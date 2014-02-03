<?php
namespace Via\Bundle\UserBundle\Entity;

use Via\Bundle\ResourceBundle\Model\EntityRepository;

class BlackboxUserRepository extends EntityRepository
{
    public function findEnabledUser ($user)
    {
        $queryBuilder = $this->getCollectionQueryBuilder();
        
        $queryBuilder
            ->Where('via_user.id != :id')
            ->andWhere('via_user.enviroment = :enviroment')
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
	    return 'via_user';
	}

}