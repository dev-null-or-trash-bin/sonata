<?php
namespace Via\Bundle\UserBundle\Entity;

use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\Column(name="first_name", type="string", length=55, nullable=true)     
     */
    protected $firstName;
    
    /**
     * @ORM\Column(name="last_name", type="string", length=55, nullable=true)
     */
    protected $lastName;
    
    /**
     * @ORM\ManyToMany(targetEntity="Via\Bundle\GroupBundle\Entity\Group")
     * @ORM\JoinTable(name="fos_user_group",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="group_id", referencedColumnName="id")}
     * )
     */
    protected $groups;

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }
    
    public function getFullName()
    {
        return $this->firstName.' '.$this->lastName;
    }
    
    /**
     * {@inheritdoc}
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    
        return $this;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getFirstName()
    {
        return $this->firstName;
    }
    
    /**
     * {@inheritdoc}
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    
        return $this;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getLastName()
    {
        return $this->lastName;
    }
}