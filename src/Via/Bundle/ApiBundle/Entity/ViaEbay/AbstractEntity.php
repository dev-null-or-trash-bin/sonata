<?php
namespace Via\Bundle\ApiBundle\Entity\ViaEbay;

abstract class AbstractEntity
{
    public function toArray ()
    {
        $class = get_called_class();
        $props = get_object_vars($class::getInstance());
        $result = array();
        foreach ($props as $name => $value)
        {
            $result[$name] = $value;
        }
        
        return $result;
    }
}