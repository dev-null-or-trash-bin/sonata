<?php
namespace Via\Bundle\UserBundle\EventListener\ViaEbay;

use Symfony\Component\EventDispatcher\Event;
use Doctrine\Common\Util\Debug;
use Via\Bundle\UserBundle\Model\ViaEbayUserInterface;
use Via\Bundle\UserBundle\Model\ViaEbayUserManagerInterface;

class UserUpdateListener
{
    protected $userManager;
    
    public function processUser(Event $event)
    {
        $admin = $event->getAdmin();
        $user = $event->getObject();
        
        if (!$user instanceof ViaEbayUserInterface)
        {
            throw new \InvalidArgumentException(
                'User update listener requires event subject to be instance of "Via\Bundle\UserBundle\Model\ViaEbayUserInterface".'
            );
        }
        
        $this->userManager->disableUsers($user);
    }
    
    public function setUserManager (ViaEbayUserManagerInterface $userManager)
    {
        $this->userManager = $userManager;
    }
}