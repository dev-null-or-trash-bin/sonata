<?php
namespace Via\Bundle\ApiBundle\Context\Blackbox;

use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Via\Bundle\GuzzleBundle\Context\Blackbox\EnviromentContext as BaseEnviromentContext;
use Doctrine\Common\Util\Debug;

class EnviromentContext extends BaseEnviromentContext
{
    protected $session;
        
    public function __construct(SessionInterface $session)
    {
        #print_r(__METHOD__ . '<br/>');
        $this->session = $session;
        parent::__construct($session, $this->getDefaultEnviroment());
    }
    
    public function getDefaultEnviroment()
    {
        #print_r(__METHOD__ . '<br/>');
        return parent::getDefaultEnviroment();
        #return $this->settingsManager->loadSettings('general')->get('currency');
    }
    
    public function getEnviroment()
    {
        return parent::getEnviroment();
        #return $this->session->get('blackbox')->get('enviroment', $this->defaultEnviroment);
    }
    
    public function setEnviroment($enviroment)
    {
        return parent::setEnviroment($enviroment);
        #return $this->session->set('blackbox', array('enviroment' => $enviroment));
    }
}