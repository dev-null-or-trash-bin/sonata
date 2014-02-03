<?php
namespace Via\Bundle\ProductBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

abstract class PropertyChoiceType extends AbstractType
{
    /**
     * Property class name.
     *
     * @var string
     */
    protected $className;
    
    /**
     * Constructor.
     *
     * @param string $className
     */
    public function __construct($className)
    {
        $this->className = $className;
    }
    
    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver
        ->setDefaults(array(
            'class' => $this->className
        ))
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'via_property_choice';
    }
}