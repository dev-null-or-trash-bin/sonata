<?php
namespace Via\Bundle\ProductBundle\Entity;

class PropertyTypes
{
    const TEXT     = 'text';
    const NUMBER   = 'number';
    const CHOICE   = 'choice';
    const CHECKBOX = 'checkbox';
    
    public static function getChoices()
    {
        return array(
            self::TEXT     => 'Text',
            self::NUMBER   => 'Number',
            self::CHOICE   => 'Choice',
            self::CHECKBOX => 'Checkbox',
        );
    }
}