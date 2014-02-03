<?php
namespace Via\Bundle\BlackboxBundle\Controller;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Sonata\AdminBundle\Controller\CRUDController as Controller;
use Via\Bundle\BlackboxBundle\Entity\EnviromentTypes;

class UserAdminController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function listAction()
    {
        
        $client = $this->container->get('guzzle.client');
        #$loggerPlugin = $this->container->get('playbloom_guzzle.client.plugin.logger');
        #$client->addSubscriber($loggerPlugin);
        $request = $client->get('http://www.afterbuy.de');
        $response = $request->send();
        
        $datagrid = $this->admin->getDatagrid();
        $users = $datagrid->getResults();
        
        $minOneEnabled['sandbox'] = false;
        $minOneEnabled['live'] = false;
        foreach ($users as $user)
        {
            if ($user->getEnabled() && $user->getEnviroment() === EnviromentTypes::SANDBOX)
                $minOneEnabled['sandbox'] = true;
            
            if ($user->getEnabled() && $user->getEnviroment() === EnviromentTypes::LIVE)
                $minOneEnabled['live'] = true;
        }
        
        if (false === $minOneEnabled['sandbox'] && false === $minOneEnabled['live'])
        {
            $this->addFlash('sonata_flash_error', 'via.message.list.no_viaebay_user_is_enabled');
        } elseif (false === $minOneEnabled['sandbox'])
        {
            $this->addFlash('sonata_flash_error', 'via.message.list.no_viaebay_sandbox_user_is_enabled');
        } elseif (false === $minOneEnabled['live'])
        {
            $this->addFlash('sonata_flash_error', 'via.message.list.no_viaebay_live_user_is_enabled');
        } else {
            $this->addFlash('sonata_flash_warning', 'via.message.list.viaebay_only_one_user_can_be_enabled');
        }
        $result = parent::listAction();
        return $result;
    }
    
    /**
     * {@inheritdoc}
     */
    public function editAction($id = null)
    {
        if ($this->getRestMethod() != 'POST') {
            $this->addFlash('sonata_flash_warning', 'via.message.edit.viaebay_only_one_user_can_be_enabled');
        }
        $result = parent::editAction();
        return $result;
    }
}