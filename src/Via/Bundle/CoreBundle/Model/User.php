<?php
namespace Via\Bundle\CoreBundle\Model;

use Sonata\UserBundle\Entity\BaseUser as BaseUser;

class User extends BaseUser implements UserInterface
{
    protected $groups;

    /**
     * @var integer $id
     */
    protected $id;
    
    /**
     * Get id
     *
     * @return integer $id
     */
    public function getId()
    {
        return $this->id;
    }
    
    public function __construct()
    {
        parent::__construct();
        // your own logic
    }

    
}