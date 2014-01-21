<?php
namespace Via\Bundle\UserBundle\Entity;

use Sonata\UserBundle\Entity\BaseUser as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user_user")
 */
class User extends BaseUser implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @var unknown
     *
     * @ORM\Column(name="viaebay_username", type="string", length=255, nullable=true)
     */
    protected $viaebay_username;
    
    /**
     * @var unknown
     *
     * @ORM\Column(name="viaebay_password", type="string", length=255, nullable=true)
     */
    protected $viaebay_password;
    
    /**
     * @var unknown
     *
     * @ORM\Column(name="viaebay_token", type="string", length=255, nullable=true)
     */
    protected $viaebay_token;
    
    /**
     * @ORM\ManyToMany(targetEntity="Group")
     * @ORM\JoinTable(name="fos_user_user_group",
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

    public function getViaebayUsername()
    {
        return $this->viaebay_username;
    }

    public function setViaebayUsername($viaebay_username)
    {
        $this->viaebay_username = $viaebay_username;
        return $this;
    }

    public function getViaebayPassword()
    {
        return $this->viaebay_password;
    }

    public function setViaebayPassword($viaebay_password)
    {
        $this->viaebay_password = $viaebay_password;
        return $this;
    }

    public function getViaebayToken()
    {
        return $this->viaebay_token;
    }

    public function setViaebayToken($viaebay_token)
    {
        $this->viaebay_token = $viaebay_token;
        return $this;
    }
	
}