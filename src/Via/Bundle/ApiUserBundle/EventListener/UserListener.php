<?php
namespace Via\Bundle\ApiUserBundle\EventListener;

use Symfony\Component\EventDispatcher\GenericEvent;
use Via\Bundle\ApiUserBundle\Entity\UserInterface;
use Via\Bundle\ApiUserBundle\UserProcessing\UserStateResolverInterface;

class UserListener
{
    /**
     * States resolver.
     *
     * @var StateResolverInterface
     */
    protected $enableResolver;
    /**
     * Constructor.
     *
     * @param StateResolverInterface $stateResolver
     */
    public function __construct(UserStateResolverInterface $enableResolver)
    {
        $this->enableResolver = $enableResolver;
    }
    
    
    public function processUser (GenericEvent $event)
    {
        $user = $event->getSubject();
        
        if (!$user instanceof UserInterface) {
            throw new \InvalidArgumentException(
                'User enable listener requires event subject to be an instance of "Via\Bundle\ApiUserBundle\Entity\UserInterface"'
            );
        }
        
        #if ($user->getEnabled())
        #{
            $this->enableResolver->disableOtherUser($user);
        #}
    }
    
}