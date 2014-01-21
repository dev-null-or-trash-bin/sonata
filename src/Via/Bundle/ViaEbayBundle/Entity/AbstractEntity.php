<?php
namespace Via\Bundle\ApiBundle\Platform\ViaEbay\Entity;

use Sonata\AdminBundle\Admin\BaseFieldDescription;

class BaseEntity
{
    public function toArray ()
    {
        #BaseFieldDescription::camelize();
        
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