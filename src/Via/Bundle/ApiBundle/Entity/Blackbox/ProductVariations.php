<?php
namespace Via\Bundle\ApiBundle\Entity\Blackbox;

class ProductVariations extends AbstractEntity
{
    protected $ProductId;
    
    protected $Price;
    
    protected $StockAmount;
    
    protected $Sku;
    
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

    public function getProductId()
    {
        return $this->ProductId;
    }

    public function setProductId($ProductId)
    {
        $this->ProductId = $ProductId;
        return $this;
    }

    public function getPrice()
    {
        return $this->Price;
    }

    public function setPrice($Price)
    {
        $this->Price = $Price;
        return $this;
    }

    public function getStockAmount()
    {
        return $this->StockAmount;
    }

    public function setStockAmount($StockAmount)
    {
        $this->StockAmount = $StockAmount;
        return $this;
    }

    public function getSku()
    {
        return $this->Sku;
    }

    public function setSku($Sku)
    {
        $this->Sku = $Sku;
        return $this;
    }
	
}