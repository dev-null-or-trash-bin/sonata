<?php
namespace Via\Bundle\GuzzleBundle\Plugin\Blackbox;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\EventDispatcher\Event;

class RequestParamPlugin implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return array(            
            'command.before_send' => array('onCommandBeforeSend', 255),
            'command.before_prepare' => array('onCommandBeforePrepare', 255)
        );
    }
    
    public function onCommandBeforeSend (Event $event)
    {
    }
    
    public function onCommandBeforePrepare (Event $event)
    {   
        $command = $event['command'];
        $client = $command->getClient();
        $client->getConfig()->set('request.params', array(
            'redirect.disable' => true
        ));
    }
}