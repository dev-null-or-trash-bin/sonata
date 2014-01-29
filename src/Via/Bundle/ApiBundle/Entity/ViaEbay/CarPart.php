<?php
namespace Via\Bundle\ApiBundle\Entity\ViaEbay;

use Via\Bundle\ApiBundle\Entity\ViaEbay\AbstractEntity;

class CarPart extends AbstractEntity
{
    protected $ProductId = null;
    protected $KType = null;
    protected $HSN = '';
    protected $TSN = '';
    protected $Comment = '';
    
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
    
    /* public function toArray ()
    {
        return array(
            'ProductId'     => $this->getProductId(),
            'KType'         => $this->getKtype(),
            'HSN'           => $this->getHsn(),
            'TSN'           => $this->getTsn(),
            'Comment'       => $this->getComment()
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
    public function getKType()
    {
        return $this->KType;
    }

    /**
     *
     * @param $Ktype
     */
    public function setKType($Ktype)
    {
        $this->KType = $Ktype;
        return $this;
    }

    /**
     *
     * @return
     */
    public function getHsn()
    {
        return $this->HSN;
    }

    /**
     *
     * @param $Hsn
     */
    public function setHsn($Hsn)
    {
        $this->HSN = $Hsn;
        return $this;
    }

    /**
     *
     * @return
     */
    public function getTsn()
    {
        return $this->TSN;
    }

    /**
     *
     * @param $Tsn
     */
    public function setTsn($Tsn)
    {
        $this->TSN = $Tsn;
        return $this;
    }
    /**
     *
     * @return
     */
    public function getComment()
    {
        return $this->Comment;
    }

    /**
     *
     * @param $Comment
     */
    public function setComment($Comment)
    {
        $this->Comment = $Comment;
        return $this;
    }
   

}