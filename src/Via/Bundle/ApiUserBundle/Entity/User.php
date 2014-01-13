<?php
namespace Via\Bundle\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="api_user")
 */
class User
{
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
     * @ORM\Column(name="enviroment", type="string", length=55, nullable=true)
     */
    protected $enviroment;
}