<?php
namespace Via\Bundle\ProductBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;

class ProductPropertyType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('property', 'via_property_choice')
        ;
    
        $prototypes = array();
        foreach ($this->getProperties($builder) as $property) {
            $prototypes[] = $builder->create('value', $property->getType())->getForm();
        }
    
        $builder->setAttribute('prototypes', $prototypes);
    }
    
    /**
     * {@inheritdoc}
     */
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars['prototypes'] = array();
    
        foreach ($form->getConfig()->getAttribute('prototypes', array()) as $name => $prototype) {
            $view->vars['prototypes'][$name] = $prototype->createView($view);
        }
    }
    
    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver
        ->setDefaults(array(
            #'data_class'        => $this->dataClass,
            #'validation_groups' => $this->validationGroups
            'data_class' => 'Via\Bundle\ProductBundle\Entity\ProductProperty',
        ))
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'via_product_property';
    }
    
    private function getProperties(FormBuilderInterface $builder)
    {
        return $builder->get('property')->getOption('choice_list')->getChoices();
    }
}