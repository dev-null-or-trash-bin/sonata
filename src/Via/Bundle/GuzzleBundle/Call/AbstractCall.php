<?php
namespace Via\Bundle\GuzzleBundle\Call;

abstract class BaseCall implements BaseCallInterface
{
    const MODE_SANDBOX = 0;
    const MODE_PRODUCT = 1;
    
    
    
    /**
     * @param $apiName (e.g. Trading, Finding, etc.)
     * @param $callName
     * @return object
     */
    static function getInstance($callName, $method)
    {
        self::$apiName = $callName;
        self::$callName = $method;
        $className = 'Via\\Bundle\\GuzzleBundle\\Call\\' . $apiName . '\\' . ucfirst($callName) . 'Call';
    
        return new $className(self::$parameters);
    }
}