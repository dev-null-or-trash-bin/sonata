<?php
namespace Via\Bundle\GuzzleBundle\Response;

use Guzzle\Service\Command\ResponseClassInterface;
use Guzzle\Service\Command\OperationCommand;

class ViaEbayAuthResponse implements ResponseClassInterface
{
    protected $cookie;

    public static function fromCommand(OperationCommand $command)
    {
        $response = $command->getResponse();
        $cookie = $response->getSetCookie();
        return new self((string) $cookie);
    }
    
    public function getCookie()
    {
        return $this->cookie;
    }

    public function __construct($cookie)
    {
        $this->cookie = $cookie;
    }
}