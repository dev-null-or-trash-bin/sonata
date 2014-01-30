<?php
namespace Via\Bundle\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Via\Bundle\UserBundle\Entity\User;
use Via\Bundle\UserBundle\Model\BlackboxUser as AbstractBlackboxUser ;
use Via\Bundle\UserBundle\Model\BlackboxUserInterface;
/**
 * @ORM\Entity(repositoryClass="BlackboxUserRepository")
 * @ORM\Table(name="viaebay_user")
 */
class BlackboxUser implements BlackboxUserInterface
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
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    protected $name;
    
    /**
     * @var unknown
     *
     * @ORM\Column(name="username", type="string", length=255, nullable=true)
     */
    protected $username;
    
    /**
     * @var unknown
     *
     * @ORM\Column(name="password", type="string", length=255, nullable=true)
     */
    protected $password;
    
    /**
     * @var unknown
     *
     * @ORM\Column(name="token", type="string", length=255, nullable=true)
     */
    protected $token;
    
    /**
     * @var unknown
     *
     * @ORM\Column(name="enabled", type="boolean", nullable=true)
     */
    protected $enabled;
    
    /**
     * @var unknown
     *
     * @ORM\Column(name="enviroment", type="string", length=50, nullable=true)
     */
    protected $enviroment;
      
    
    public function __toString()
    {
        return ($this->getName()) ? : $this->getUsername();
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    public function getToken()
    {
        return $this->token;
    }

    public function setToken($token)
    {
        $this->token = $token;
        return $this;
    }

    public function getEnabled()
    {
        return $this->enabled;
    }

    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;
        return $this;
    }

    public function getEnviroment()
    {
        return $this->enviroment;
    }

    public function setEnviroment($enviroment)
    {
        $this->enviroment = $enviroment;
        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }
	
}