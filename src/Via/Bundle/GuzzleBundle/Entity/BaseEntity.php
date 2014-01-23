<?php
namespace Via\Bundle\GuzzleBundle\Entity;

use Sonata\AdminBundle\Admin\BaseFieldDescription;

class BaseEntity implements EntityInterface
{
    public function toArray ()
    {
        $class = get_called_class();
        $props = get_object_vars($class::getInstance());
        $result = array();
        foreach ($props as $name => $value)
        {
            $result[BaseFieldDescription::camelize($name)] = $value;
        }
        
        return $result;
    }
}