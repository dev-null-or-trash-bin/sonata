<?php
namespace Via\Bundle\ProductBundle\Model;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Model
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(name="product_property")
 *
 */
class ProductProperty implements ProductPropertyInterface
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @var \Product
     *
     * @ORM\ManyToOne(targetModel="Product", inversedBy="properties")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     * })
     */
    private $product;
    
    /**
     * @var \Property
     *
     * @ORM\ManyToOne(targetModel="Property", inversedBy="products")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="property_id", referencedColumnName="id")
     * })
     */
    protected $property;
    
    /**
     * Property value.
     *
     * @ORM\Column(name="value", type="string", length=255, nullable=false)
     */
    protected $value;
    
    public function __toString()
    {
        return ($this->getValue()) ? : '';
    }
    
    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getProduct()
    {
        return $this->product;
    }
    
    /**
     * {@inheritdoc}
     */
    public function setProduct(Product $product = null)
    {
        $this->product = $product;
    
        return $this;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getProperty()
    {
        return $this->property;
    }
    
    /**
     * {@inheritdoc}
     */
    public function setProperty(Property $property)
    {
        $this->property = $property;
    
        return $this;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getValue()
    {
        if ($this->property && PropertyTypes::CHECKBOX === $this->property->getType()) {
            return (boolean) $this->value;
        }
    
        return $this->value;
    }
    
    /**
     * {@inheritdoc}
     */
    public function setValue($value)
    {
        $this->value = $value;
    
        return $this;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        $this->assertPropertyIsSet();
    
        return $this->property->getName();
    }
    
    /**
     * {@inheritdoc}
     */
    public function getPresentation()
    {
        $this->assertPropertyIsSet();
    
        return $this->property->getPresentation();
    }
    
    public function getType()
    {
        $this->assertPropertyIsSet();
    
        return $this->property->getType();
    }
    
    public function getConfiguration()
    {
        $this->assertPropertyIsSet();
    
        return $this->property->getConfiguration();
    }
    
    /**
     * @throws \BadMethodCallException When property is not set
     */
    protected function assertPropertyIsSet()
    {
        if (null === $this->property) {
            throw new \BadMethodCallException('The property have not been created yet so you cannot access proxy methods.');
        }
    }
}