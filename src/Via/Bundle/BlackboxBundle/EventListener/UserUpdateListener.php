<?php
namespace Via\Bundle\UserBundle\EventListener\Blackbox;

use Symfony\Component\EventDispatcher\Event;
use Doctrine\Common\Util\Debug;
use Via\Bundle\UserBundle\Model\BlackboxUserInterface;
use Via\Bundle\UserBundle\Model\BlackboxUserManagerInterface;

class UserUpdateListener
{
    protected $userManager;
    
    public function processUser(Event $event)
    {
        $admin = $event->getAdmin();
        $user = $event->getObject();
        
        if (!$user instanceof BlackboxUserInterface)
        {
            throw new \InvalidArgumentException(
                'User update listener requires event subject to be instance of "Via\Bundle\UserBundle\Model\BlackboxUserInterface".'
            );
        }
        
        $this->userManager->disableUsers($user);
    }
    
    public function setUserManager (BlackboxUserManagerInterface $userManager)
    {
        $this->userManager = $userManager;
    }
}