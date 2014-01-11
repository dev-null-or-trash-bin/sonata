<?php
namespace Via\Bundle\PropertyBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Via\Bundle\PropertyBundle\Entity\PropertyTypes;

class PropertyType extends AbstractType
{
    /**
     * Data class.
     *
     * @var string
     */
    protected $dataClass;
    /**
     * Constructor.
     *
     * @param string $dataClass
     * @param array  $validationGroups
     */
    public function __construct($dataClass, array $validationGroups = null)
    {
        $this->dataClass = $dataClass;
        $this->validationGroups = $validationGroups;
    }
    
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('name', 'text', array(
            'label' => 'via.label.property.name'
        ))
        ->add('presentation', 'text', array(
            'label' => 'via.label.property.presentation'
        ))
        ->add('type', 'choice', array(
            'choices' => PropertyTypes::getChoices()
        ))
        #->addEventSubscriber(new BuildPropertyFormChoicesListener($builder->getFormFactory()))
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver
        ->setDefaults(array(
            'data_class'        => $this->dataClass,
            'validation_groups' => $this->validationGroups
        ))
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'via_property';
    }
}