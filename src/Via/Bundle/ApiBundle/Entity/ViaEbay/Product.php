<?php
namespace Via\Bundle\ApiBundle\Entity\ViaEbay;

use Via\Bundle\ApiBundle\Entity\ViaEbay\AbstractEntity;

class Product extends AbstractEntity
{
    protected $Id = null;
    
    protected $Title = null;

    protected $Description = null;

    protected $StockAmount = 0;

    protected $Price = 0.00;

    protected $ProductType = 0;
    
    protected $UnitQuantity = null;
    
    protected $UnitType = null;
    
    protected $Ean = null;
    
    protected $DisableAutomatch = false;
    
    protected $ConditionId = null;
    
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
    
//     public function toArray()
//     {
//         return array(
//             'Title'         => $this->getTitle(),
//             'Description'   => $this->getDescription(),
//             'StockAmount'   => $this->getStockAmount(),
//             'Price'         => $this->getPrice(),
//             'ProductType'   => $this->getProductType()
//         );
//     }

    /**
     *
     * @return
     */
    public function getTitle()
    {
        return $this->Title;
    }

    /**
     *
     * @param $Title
     */
    public function setTitle($Title)
    {
        $this->Title = $Title;
        return $this;
    }

    /**
     *
     * @return
     */
    public function getDescription()
    {
        return $this->Description;
    }

    /**
     *
     * @param $Description
     */
    public function setDescription($Description)
    {
        $this->Description = $Description;
        return $this;
    }

    /**
     *
     * @return
     */
    public function getStockAmount()
    {
        return $this->StockAmount;
    }

    /**
     *
     * @param $StockAmount
     */
    public function setStockAmount($StockAmount)
    {
        $this->StockAmount = $StockAmount;
        return $this;
    }

    /**
     *
     * @return
     */
    public function getPrice()
    {
        return $this->Price;
    }

    /**
     *
     * @param $Price
     */
    public function setPrice($Price)
    {
        $this->Price = $Price;
        return $this;
    }

    /**
     *
     * @return
     */
    public function getProductType()
    {
        return $this->ProductType;
    }

    /**
     *
     * @param $ProductType
     */
    public function setProductType($ProductType)
    {
        $this->ProductType = $ProductType;
        return $this;
    }
    
    public function getId()
    {
        return $this->Id;
    }

    public function setId($Id)
    {
        $this->Id = $Id;
        return $this;
    }

    /**
     *
     * @return
     */
    public function getUnitQuantity()
    {
        return $this->UnitQuantity;
    }

    /**
     *
     * @param $UnitQuantity
     */
    public function setUnitQuantity($UnitQuantity)
    {
        $this->UnitQuantity = $UnitQuantity;
        return $this;
    }

    /**
     *
     * @return
     */
    public function getUnitType()
    {
        return $this->UnitType;
    }

    /**
     *
     * @param $UnitType
     */
    public function setUnitType($UnitType)
    {
        $this->UnitType = $UnitType;
        return $this;
    }

    public function getEan()
    {
        return $this->Ean;
    }

    public function setEan($ean)
    {
        $this->Ean = $ean;
        return $this;
    }

    public function getDisableAutomatch()
    {
        return $this->DisableAutomatch;
    }

    public function setDisableAutomatch($DisableAutomatch)
    {
        $this->DisableAutomatch = $DisableAutomatch;
        return $this;
    }

    public function getConditionId()
    {
        return $this->ConditionId;
    }

    public function setConditionId($ConditionId)
    {
        $this->ConditionId = $ConditionId;
        return $this;
    }
	
	
	
}