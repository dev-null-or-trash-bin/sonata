<?php
namespace Via\Bundle\GuzzleBundle\Context\Blackbox;

use Symfony\Component\HttpFoundation\Session\SessionInterface;

class EnviromentContext implements EnviromentContextInterface
{
    protected $session;
    protected $defaultEnviroment;
    
    public function __construct(SessionInterface $session, $defaultEnviroment)
    {
        #print_r(__METHOD__ . '<br/>');
        $this->session = $session;
        $this->defaultEnviroment = $defaultEnviroment;
    }
    
    public function getDefaultEnviroment()
    {
        return $this->defaultEnviroment;
    }
    
    public function getEnviroment()
    {
        return $this->session->get('blackbox')->get('enviroment', $this->defaultEnviroment);
    }
    
    public function setEnviroment($enviroment)
    {
        return $this->session->set('blackbox', array('enviroment' => $enviroment));
    }
}