<?php
namespace Via\Bundle\CoreBundle\Model;

use Sonata\UserBundle\Entity\BaseGroup as BaseGroup;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

class Group extends BaseGroup implements GroupInterface
{    
    use ORMBehaviors\Timestampable\Timestampable;
    
    protected $id;
    
    public function __toString()
    {
        return ($this->getName()) ? : '';
    }
}