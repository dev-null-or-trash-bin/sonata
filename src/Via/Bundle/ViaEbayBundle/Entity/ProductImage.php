<?php
namespace Via\Rest\Entity;

use Via\Rest\Entity\AbstractEntity;

class ProductImage extends AbstractEntity
{
    private static $instance = null;
    protected $ProductId = null;
    protected $ImageUrl  = null;
    protected $Type = 1;
    
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
        return new ProductImage();
    }
        

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
    public function getImageUrl()
    {
        return $this->ImageUrl;
    }

    /**
     * 
     * @param $ImageUrl
     */
    public function setImageUrl($ImageUrl)
    {
        $this->ImageUrl = $ImageUrl;
        return $this;
    }

    /**
     * 
     * @return 
     */
    public function getType()
    {
        return $this->Type;
    }

    /**
     * 
     * @param $Type
     */
    public function setType($Type)
    {
        $this->Type = $Type;
        return $this;
    }
    
    /* public function toArray ()
    {
        return array (
        	'ProductId'    => $this->getProductId(),
            'ImageUrl'     => $this->getImageUrl(),
            'Type'         => $this->getType() 
        );
    } */
}