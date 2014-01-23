<?php
namespace Via\Bundle\GuzzleBundle\Entity;

use Via\Bundle\GuzzleBundle\Entity\BaseEntity;

class ProductSpecific extends BaseEntity
{
    private static $instance = null;
    protected $ProductId = null;
    protected $Name  = null;
    protected $Value = null;
    
    /**
     * We made the constructor private to force the factory style.
     * This was
     * done to keep the syntax cleaner and better the support the idea of
     * "default templates". Very basic and flexible as it is only intended
     * for internal use.
     */
    private function __construct()
    {}
    
    public function getInstance()
    {
        if (null === static::$instance)
            static::$instance = self::init();
    
        return static::$instance;
    }
     
    public static function init()
    {
        return new ProductSpecific();
    }
    
    /* public function toArray ()
    {
        return array (
            'ProductId'     => $this->getProductId(),
            'Name'          => $this->getName(),
            'Value'         => $this->getValue()
        );
    } */

    /**
     *
     * @return
     */
    public function getProductId()
    {
        return $this->ProductId;
    }

    /**
     *
     * @param $ProductId
     */
    public function setProductId($ProductId)
    {
        $this->ProductId = $ProductId;
        return $this;
    }

    /**
     *
     * @return
     */
    public function getName()
    {
        return $this->Name;
    }

    /**
     *
     * @param $Name
     */
    public function setName($Name)
    {
        $this->Name = $Name;
        return $this;
    }

    /**
     *
     * @return
     */
    public function getValue()
    {
        return $this->Value;
    }

    /**
     *
     * @param $Value
     */
    public function setValue($Value)
    {
        $this->Value = $Value;
        return $this;
    }
}