<?php
namespace Via\Bundle\ApiBundle\Entity;

final class EnviromentTypes
{
    const LIVE      = 'live';
    const SANDBOX   = 'sandbox';
    
    public static function getChoices()
    {
        return array(
            self::LIVE      => 'Live',
            self::SANDBOX   => 'Sandbox',
        );
    }
}