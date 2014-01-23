<?php
namespace Via\Bundle\GuzzleBundle\Entity;

use Via\Bundle\GuzzleBundle\Entity\BaseEntity;

class Product extends BaseEntity
{
    private static $instance = null;
    
    protected $id = null;
    
    protected $title = null;

    protected $description = null;

    protected $stock_amount = 0;

    protected $price = 0.00;

    protected $product_type = 0;
    
    protected $unit_quantity = null;
    
    protected $unit_type = null;
    
    protected $ean = null;
    
    protected $disable_automatch = false;
    
    protected $condition_id = null;

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
        return new Product();
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

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    public function getStockAmount()
    {
        return $this->stock_amount;
    }

    public function setStockAmount($stock_amount)
    {
        $this->stock_amount = $stock_amount;
        return $this;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price)
    {
        $this->price = $price;
        return $this;
    }

    public function getProductType()
    {
        return $this->product_type;
    }

    public function setProductType($product_type)
    {
        $this->product_type = $product_type;
        return $this;
    }

    public function getUnitQuantity()
    {
        return $this->unit_quantity;
    }

    public function setUnitQuantity($unit_quantity)
    {
        $this->unit_quantity = $unit_quantity;
        return $this;
    }

    public function getUnitType()
    {
        return $this->unit_type;
    }

    public function setUnitType($unit_type)
    {
        $this->unit_type = $unit_type;
        return $this;
    }

    public function getEan()
    {
        return $this->ean;
    }

    public function setEan($ean)
    {
        $this->ean = $ean;
        return $this;
    }

    public function getDisableAutomatch()
    {
        return $this->disable_automatch;
    }

    public function setDisableAutomatch($disable_automatch)
    {
        $this->disable_automatch = $disable_automatch;
        return $this;
    }

    public function getConditionId()
    {
        return $this->condition_id;
    }

    public function setConditionId($condition_id)
    {
        $this->condition_id = $condition_id;
        return $this;
    }
}