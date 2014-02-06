<?php
namespace Via\Bundle\ProductBundle\Model;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * @ORM\Model
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(name="property")
 * @ORM\Model(repositoryClass="Via\Bundle\ProductBundle\Repository\PropertyRepository")
 */
class Property implements PropertyInterface
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    protected $name;
    
    /**
     * Type.
     * @ORM\Column(name="type", type="string", length=255, nullable=false)
     */
    protected $type;
    
    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetModel="ProductProperty", mappedBy="property")
     */
    protected $products;
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->products = new ArrayCollection();
    }
    
    public function __toString()
    {
        return ($this->getName()) ? : '';
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

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }
    
    public function getPresentation()
    {
        return $this->translate()->getPresentation();
    }
    
    public function setPresentation($presentation)
    {
        $this->translate()->setPresentation($presentation);
        return $this;
    }
	
}