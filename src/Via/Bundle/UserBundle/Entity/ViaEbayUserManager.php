<?php
namespace Via\Bundle\UserBundle\Entity;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\NoResultException;
use Via\Bundle\UserBundle\Model\ViaEbayUserManager as ModelViaEbayUserManager;
use Via\Bundle\UserBundle\Model\ViaEbayUserInterface;
use Doctrine\Common\Util\Debug;

class ViaEbayUserManager extends ModelViaEbayUserManager
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    protected $em;
    
    /**
     * @param \Doctrine\ORM\EntityManager $em
     * @param string                      $class
     */
    public function __construct(EntityManager $em, $class)
    {
        $this->em    = $em;
        $this->class = $class;
    }
    
    /**
     * {@inheritDoc}
     */
    public function save(ViaEbayUserInterface $user)
    {
        $this->em->persist($user);
        $this->em->flush();
    }
    
    /**
     * {@inheritDoc}
     */
    public function findOneBy(array $criteria)
    {
        return $this->em->getRepository($this->class)->findOneBy($criteria);
    }
    
    /**
     * {@inheritDoc}
     */
    public function findBy(array $criteria)
    {
        return $this->em->getRepository($this->class)->findBy($criteria);
    }
    
    /**
     * {@inheritDoc}
     */
    public function delete(ViaEbayUserInterface $user)
    {
        $this->em->remove($user);
        $this->em->flush();
    }
    
    public function disableUsers (ViaEbayUserInterface $user)
    {
        if ($user->getEnabled())
        {
            $users = $this->em->getRepository($this->class)->findEnabledUser($user);
            foreach($users as $user)
            {
                $user->setEnabled(0);
                $this->em->flush();
            }
        }
    }
}