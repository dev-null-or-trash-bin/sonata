<?php
namespace Via\Bundle\ApiUserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * @ORM\Table(name="api_user")
 * @ORM\Entity(repositoryClass="Via\Bundle\ApiUserBundle\Repository\User")
 */
class User implements UserInterface
{
    use ORMBehaviors\Timestampable\Timestampable;
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="username", type="string", length=55, nullable=false)
     */
    protected $username;

    /**
     * @ORM\Column(name="password", type="string", length=255, nullable=true)
     */
    protected $password;

    /**
     * @ORM\Column(name="token", type="string", length=55, nullable=true)
     */
    protected $token;
    
    /**
     * @ORM\Column(name="enviroment", type="string", length=55, nullable=true)
     */
    protected $enviroment;
    
    /**
     * @ORM\Column(name="platform", type="string", length=55, nullable=true)
     */
    protected $platform;
    
    /**
     * @ORM\Column(name="enabled", type="boolean", nullable=false, options={"default"= 0})
     */
    protected $enabled;
    
    public function __toString()
    {
        return ($this->getUsername()) ? : '';
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

    public function getEnviroment()
    {
        return $this->enviroment;
    }

    public function setEnviroment($enviroment)
    {
        $this->enviroment = $enviroment;
        return $this;
    }

    public function getPlatform()
    {
        return $this->platform;
    }

    public function setPlatform($platform)
    {
        $this->platform = $platform;
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
	
	
}