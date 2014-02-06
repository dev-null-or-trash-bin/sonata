<?php
namespace Via\Bundle\VariableProductBundle\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * @ORM\Model
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(name="option")
 * @ORM\Model(repositoryClass="Via\Bundle\VariableProductBundle\Repository\OptionRepository")
 */
class Option implements OptionInterface
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
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetModel="OptionValue", mappedBy="option")
     */
    protected $values;
    

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->values = new ArrayCollection();
        //$this->createdAt = new \DateTime();
    }

    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return $this->name;
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
    public function getName()
    {
        return $this->name;
    }

    /**
     * {@inheritdoc}
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
//     public function getPresentation()
//     {
//         return $this->presentation;
//     }

    /**
     * {@inheritdoc}
     */
//     public function setPresentation($presentation)
//     {
//         $this->presentation = $presentation;

//         return $this;
//     }

    public function getPresentation()
    {
        return $this->translate()->getPresentation();
    }
    
    public function setPresentation($presentation)
    {
        $this->translate()->setPresentation($presentation);
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getValues()
    {
        return $this->values;
    }

    /**
     * {@inheritdoc}
     */
    public function setValues(Collection $values)
    {
        $this->values = $values;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function addValue(OptionValueInterface $value)
    {
        if (!$this->hasValue($value)) {
            $value->setOption($this);
            $this->values->add($value);
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function removeValue(OptionValueInterface $value)
    {
        if ($this->hasValue($value)) {
            $this->values->removeElement($value);
            $value->setOption(null);
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function hasValue(OptionValueInterface $value)
    {
        return $this->values->contains($value);
    }
}
