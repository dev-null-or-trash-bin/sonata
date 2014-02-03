<?php
namespace Via\Bundle\BlackboxBundle\EventListener;

use Doctrine\Common\Persistence\ObjectRepository;
use Via\Bundle\BlackboxBundle\Entity\UserInterface;
use Sonata\AdminBundle\Event\PersistenceEvent;

class UserUpdateListener
{
    /**
     * Blackbox User repository.
     *
     * @var ObjectRepository
     */
    protected $repository;
    
    public function __construct(ObjectRepository $repository)
    {
        $this->repository = $repository;
    }
    
    public function processUser(PersistenceEvent $event)
    {
        $user = $event->getObject();
        
        if (!$user instanceof UserInterface)
        {
            throw new \InvalidArgumentException(
                'User update listener requires event subject to be instance of "Via\Bundle\BlackboxBundle\Entity\UserInterface".'
            );
        }
        
        
    }
}