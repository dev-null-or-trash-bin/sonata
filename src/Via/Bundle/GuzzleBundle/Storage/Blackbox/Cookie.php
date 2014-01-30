<?php
namespace Via\Bundle\GuzzleBundle\Storage\Blackbox;

class Cookie
{   
    /**
     * @var null|object DateTime
     */
    static protected $expireDate = null;
    
    /**
     * @var string
     */
    static protected $value = null;
    
    public static function setValue($value)
    {
        self::$value = $value;
    }
    
    public static function getValue()
    {
        return self::$value;
    }
    
    public static function setExpireDate (\DateTime $expireDate)
    {
        self::$expireDate = $expireDate;
    }
    
    public static function getExpireDate ()
    {
        return self::$expireDate;
    }
}