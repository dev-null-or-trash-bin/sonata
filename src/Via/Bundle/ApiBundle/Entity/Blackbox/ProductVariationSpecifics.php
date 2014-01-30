<?php
namespace Via\Bundle\ApiBundle\Entity\Blackbox;

class ProductVariationSpecifics extends AbstractEntity
{
    protected $ProductVariationId;
    
    protected $Name;
    
    protected $Value;
    
    protected static $instance = null;
    
    /**
     * We made the constructor private to force the factory style.
     * This was
     * done to keep the syntax cleaner and better the support the idea of
     * "default templates". Very basic and flexible as it is only intended
     * for internal use.
     */
    final private function __construct()
    {}
    
    public static function init()
    {
        return new self();
    }
    
    public function getInstance()
    {
        if (null === static::$instance)
            static::$instance = self::init();
    
        return static::$instance;
    }

    public function getProductVariationId()
    {
        return $this->ProductVariationId;
    }

    public function setProductVariationId($ProductVariationId)
    {
        $this->ProductVariationId = $ProductVariationId;
        return $this;
    }

    public function getName()
    {
        return $this->Name;
    }

    public function setName($Name)
    {
        $this->Name = $Name;
        return $this;
    }

    public function getValue()
    {
        return $this->Value;
    }

    public function setValue($Value)
    {
        $this->Value = $Value;
        return $this;
    }
	
}