<?php
namespace Via\Bundle\ProductBundle\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class Product implements ProductInterface
{
    /**
     * Product id.
     *
     * @var mixed
     */
    protected $id;

    /**
     * Product name.
     *
     * @var string
     */
    protected $name;

    /**
     * Permalink for the product.
     * Used in url to access it.
     *
     * @var string
     */
    protected $slug;

    /**
     * Product description.
     *
     * @var string
     */
    protected $description;

    /**
     * Available on.
     *
     * @var \DateTime
     */
    protected $availableOn;

    /**
     * Meta keywords.
     *
     * @var string
     */
    protected $metaKeywords;

    /**
     * Meta description.
     *
     * @var string
     */
    protected $metaDescription;

    /**
     * Properties.
     *
     * @var ProductPropertyInterface[]
     */
    protected $properties;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->availableOn = new \DateTime();
        $this->properties = new ArrayCollection();
        $this->createdAt = new \DateTime();
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
    public function isAvailable()
    {
        return new \DateTime() >= $this->availableOn;
    }

    /**
     * {@inheritdoc}
     */
    public function getAvailableOn()
    {
        return $this->availableOn;
    }

    /**
     * {@inheritdoc}
     */
    public function setAvailableOn(\DateTime $availableOn)
    {
        $this->availableOn = $availableOn;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getMetaKeywords()
    {
        return $this->metaKeywords;
    }

    /**
     * {@inheritdoc}
     */
    public function setMetaKeywords($metaKeywords)
    {
        $this->metaKeywords = $metaKeywords;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getMetaDescription()
    {
        return $this->metaDescription;
    }

    /**
     * {@inheritdoc}
     */
    public function setMetaDescription($metaDescription)
    {
        $this->metaDescription = $metaDescription;

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
}
