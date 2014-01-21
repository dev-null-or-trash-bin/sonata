<?php
namespace Via\Bundle\ApiUserBundle\UserProcessing;

use Via\Bundle\ApiUserBundle\Entity\UserInterface;
use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\DependencyInjection\ContainerInterface;

class EnableResolver extends ContainerAware implements EnableResolverInterface
{
    public function disableOtherUser (UserInterface $user)
    {
        $currentUserId = $user->getId();
        $userRepository = $this->container->get('via.api_user.repository.user');
        
        $users = $userRepository->findByNot(array('id' => $currentUserId));
        
        foreach($users as $key => $user)
        {
            $user->setEnabled(false);
        }
        
        $users = $userRepository->findBy(array('enabled' => 1));
        
        if (count($users) == 0)
        {
            $this->get('session')->setFlash('sonata_flash_error', 'via.api_user.no_active_user_found');
        }
    }
}