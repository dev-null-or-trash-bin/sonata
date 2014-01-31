<?php
namespace Via\Bundle\ApiBundle\Event\Blackbox;

use Symfony\Component\EventDispatcher\Event;
use Via\Bundle\UserBundle\Model\BlackboxUserInterface;
use Via\Bundle\UserBundle\Model\BlackboxUserManagerInterface;
use Doctrine\Common\Util\Debug;

class UserEnabledEvent extends Event
{
    protected $userManager;
    
    public function __construct($event)
    {
        Debug::dump($event);
    }
    
    public function onUserEnabled ()
    {
	
	}

    
    public function setUserManager (BlackboxUserManagerInterface $userManager)
    {
        $this->userManager = $userManager;
    }
}