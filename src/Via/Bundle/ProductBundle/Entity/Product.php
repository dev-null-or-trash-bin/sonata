<?php
namespace Via\Bundle\ProductBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(name="product")
 * @ORM\Entity(repositoryClass="Via\Bundle\ProductBundle\Entity\Repository\Product")
 */

class Product implements ProductInterface
{
    use ORMBehaviors\Translatable\Translatable,
        ORMBehaviors\Timestampable\Timestampable;
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
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="Via\Bundle\ProductBundle\Entity\ProductProperty", mappedBy="product", cascade={"persist"}, orphanRemoval=true)
     */
    protected $properties;
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->properties = new ArrayCollection();
    }
    
    public function __toString()
    {
        return ($this->getName()) ? : '';
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
        return $this->translate()->getName();
    }

    public function setName($name)
    {
        $this->translate()->setName($name);
        return $this;
    }

    public function getDescription()
    {
        return $this->translate()->getDescription();
    }

    public function setDescription($description)
    {
        $this->translate()->setDescription($description);
        return $this;
    }

    public function getShortDescription()
    {
        return $this->translate()->getShortDescription();
    }

    public function setShortDescription($shortDescription)
    {
        $this->translate()->setShortDescription($shortDescription);
        return $this;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getProperties()
    {
        return $this->properties;
    }
    
    /**
     * {@inheritdoc}
     */
    public function setProperties(Collection $properties)
    {
        foreach ($properties as $property) {
            $this->addProperty($property);
        }
    
        return $this;
    }
    
    public function addPropertie (ProductPropertyInterface $property)
    {
        $this->addProperty($property);
    }
    
    /**
     * {@inheritdoc}
     */
    public function addProperty(ProductPropertyInterface $property)
    {
        if (!$this->hasProperty($property)) {
            $property->setProduct($this);
            $this->properties->add($property);
        }
    
        return $this;
    }
    
    /**
     * {@inheritdoc}
     */
    public function removeProperty(ProductPropertyInterface $property)
    {
        if ($this->hasProperty($property)) {
            $property->setProduct(null);
            $this->properties->removeElement($property);
        }
    
        return $this;
    }
    
    /**
     * {@inheritdoc}
     */
    public function hasProperty(ProductPropertyInterface $property)
    {
        return $this->properties->contains($property);
    }
    
    /**
     * {@inheritdoc}
     */
    public function hasPropertyByName($propertyName)
    {
        foreach ($this->properties as $property) {
            if ($property->getName() === $propertyName) {
                return true;
            }
        }
    
        return false;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getPropertyByName($propertyName)
    {
        foreach ($this->properties as $property) {
            if ($property->getName() === $propertyName) {
                return $property;
            }
        }
    
        return null;
    }
}
