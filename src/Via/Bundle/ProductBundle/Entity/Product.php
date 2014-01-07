<?php
namespace Via\Bundle\ProductBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(name="product")
 * @ORM\Entity(repositoryClass="Via\ProductBundle\Entity\Repository\Product")
 */

class Product
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="stock_amount", type="integer", nullable=false)
     */
    private $stockAmount;
    
    /**
     * @var string
     *
     * @ORM\Column(name="price", type="decimal", precision=10, scale=4, nullable=false)
     */
    private $price;
    
    /**
     * @var string
     *
     * @ORM\Column(name="vat_percent", type="decimal", precision=10, scale=2, nullable=false)
     */
    private $vatPercent = '19.00';
    
    /**
     * @var string
     *
     * @ORM\Column(name="article_number", type="string", length=255, nullable=false)
     */
    private $articleNumber;
    
    /**
     * @var string
     *
     * @ORM\Column(name="ean", type="string", length=255, nullable=false)
     */
    private $ean;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private $createdAt;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=false)
     */
    private $updatedAt;
    
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=80, nullable=false)
     */
    private $name;
    
    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;
    
    /**
     * @var string
     *
     * @ORM\Column(name="short_description", type="string", length=255, nullable=false)
     */
    private $shortDescription;
    
    /**
     * Constructor
     */
    public function __construct()
    {}
    
    /**
     * Now we tell doctrine that before we persist or update we call the updatedTimestamps() function.
     *
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function updatedTimestamps()
    {
        $this->setUpdatedAt(new \DateTime(date('Y-m-d H:i:s')));
    
        if($this->getCreatedAt() == null)
        {
            $this->getCreatedAt(new \DateTime(date('Y-m-d H:i:s')));
        }
        return $this;
    }
    
    
    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * Set stockAmount
     *
     * @param integer $stockAmount
     * @return Product
     */
    public function setStockAmount($stockAmount)
    {
        $this->stockAmount = $stockAmount;
    
        return $this;
    }
    
    /**
     * Get stockAmount
     *
     * @return integer
     */
    public function getStockAmount()
    {
        return $this->stockAmount;
    }
    
    /**
     * Set price
     *
     * @param string $price
     * @return Product
     */
    public function setPrice($price)
    {
        $this->price = $price;
    
        return $this;
    }
    
    /**
     * Get price
     *
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }
    
    /**
     * Set vatPercent
     *
     * @param string $vatPercent
     * @return Product
     */
    public function setVatPercent($vatPercent)
    {
        $this->vatPercent = $vatPercent;
    
        return $this;
    }
    
    /**
     * Get vatPercent
     *
     * @return string
     */
    public function getVatPercent()
    {
        return $this->vatPercent;
    }
    
    /**
     * Set articleNumber
     *
     * @param string $articleNumber
     * @return Product
     */
    public function setArticleNumber($articleNumber)
    {
        $this->articleNumber = $articleNumber;
    
        return $this;
    }
    
    /**
     * Get articleNumber
     *
     * @return string
     */
    public function getArticleNumber()
    {
        return $this->articleNumber;
    }
    
    /**
     * Set ean
     *
     * @param string $ean
     * @return Product
     */
    public function setEan($ean)
    {
        $this->ean = $ean;
    
        return $this;
    }
    
    /**
     * Get ean
     *
     * @return string
     */
    public function getEan()
    {
        return $this->ean;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTime $createdAt)
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTime $updatedAt)
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;
        return $this;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription(string $description)
    {
        $this->description = $description;
        return $this;
    }

    public function getShortDescription()
    {
        return $this->shortDescription;
    }

    public function setShortDescription(string $shortDescription)
    {
        $this->shortDescription = $shortDescription;
        return $this;
    }
}