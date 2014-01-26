<?php
namespace Via\Bundle\UserBundle\Entity;

use Sonata\UserBundle\Entity\BaseUser as BaseUser;
use FOS\UserBundle\Model\UserInterface;
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
     * @ORM\ManyToMany(targetEntity="Group")
     * @ORM\JoinTable(name="fos_user_user_group",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="group_id", referencedColumnName="id")}
     * )
     */
    protected $groups;
    
    /**
     * @ORM\OneToOne(targetEntity="ViaEbayUser", mappedBy="user",cascade={"persist"})
     */
    protected $viaebay_user;

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }

    public function getViaebayUser()
    {
        return $this->viaebay_user;
    }

    public function setViaebayUser($viaebay_user)
    {
        $this->viaebay_user = $viaebay_user;
        return $this;
    }	
}