<?php
namespace Via\Bundle\UserBundle\Entity;

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